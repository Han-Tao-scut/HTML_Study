<?php
require_once __DIR__ . '/config/db.php';

$results = [];
$error = '';
$message = '';

$micromambaPath = '/home/hantao/.local/bin/micromamba';
$micromambaRoot = '/spaces/funny/micromamba';
$blastEnv = 'blast';
$blastDb = __DIR__ . '/blastdb/gene_protein_db';
$tmpDir = __DIR__ . '/tmp';
$micromambaHome = $tmpDir . '/mamba-home';

if (!is_dir($tmpDir)) {
    mkdir($tmpDir, 0775, true);
}
if (!is_dir($micromambaHome)) {
    mkdir($micromambaHome, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sequence = trim($_POST['sequence'] ?? '');

    if ($sequence === '') {
        $error = 'Please provide a protein sequence query.';
    } else {
        $cleanSequence = strtoupper(preg_replace('/\s+/', '', $sequence));

        if (!preg_match('/^[ABCDEFGHIKLMNPQRSTVWXYZ*]+$/', $cleanSequence)) {
            $error = '序列格式不正确。Paste an amino-acid sequence fragment, e.g. an IL6 peptide segment字符。';
        } elseif (!file_exists($blastDb . '.pin')) {
            $error = 'The local BLASTP database has not been built. Please run script/build_blast_db.sh before sequence search.';
        } else {
            $uniqueId = uniqid('blast_', true);
            $queryFile = $tmpDir . '/' . $uniqueId . '_query.fasta';
            $outputFile = $tmpDir . '/' . $uniqueId . '_output.tsv';

            file_put_contents($queryFile, ">query1\n" . $cleanSequence . "\n");

            $cmd = 'HOME=' . escapeshellarg($micromambaHome)
                . ' MAMBA_ROOT_PREFIX=' . escapeshellarg($micromambaRoot)
                . ' ' . escapeshellarg($micromambaPath)
                . ' run -n ' . escapeshellarg($blastEnv)
                . ' blastp'
                . ' -query ' . escapeshellarg($queryFile)
                . ' -db ' . escapeshellarg($blastDb)
                . ' -outfmt ' . escapeshellarg('6 qseqid sseqid pident length evalue bitscore')
                . ' -max_target_seqs 10'
                . ' -out ' . escapeshellarg($outputFile)
                . ' 2>&1';

            $commandOutput = shell_exec($cmd);

            if (file_exists($outputFile)) {
                $lines = file($outputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                foreach ($lines as $line) {
                    $cols = explode("\t", $line);
                    $sseqid = $cols[1] ?? '';
                    $geneLink = null;

                    if (preg_match('/^gene_(\d+)\|(.+)$/', $sseqid, $matches)) {
                        $geneId = (int)$matches[1];
                        $geneSymbol = $matches[2];

                        $geneStmt = $pdo->prepare("
                            SELECT id, gene_symbol
                            FROM genes
                            WHERE id = :id OR gene_symbol = :gene_symbol
                            LIMIT 1
                        ");
                        $geneStmt->execute([
                            ':id' => $geneId,
                            ':gene_symbol' => $geneSymbol
                        ]);
                        $matchedGene = $geneStmt->fetch();

                        if ($matchedGene) {
                            $geneLink = [
                                'id' => $matchedGene['id'],
                                'gene_symbol' => $matchedGene['gene_symbol']
                            ];
                        }
                    }

                    $results[] = [
                        'qseqid' => $cols[0] ?? '',
                        'sseqid' => $sseqid,
                        'pident' => $cols[2] ?? '',
                        'length' => $cols[3] ?? '',
                        'evalue' => $cols[4] ?? '',
                        'bitscore' => $cols[5] ?? '',
                        'matched_gene' => $geneLink
                    ];
                }

                $message = count($results) > 0
                    ? 'BLASTP search completed: ' . count($results) . ' hit(s) detected.'
                    : 'BLASTP search completed with no detectable hit in the curated protein set.';
            } else {
                $error = "BLASTP execution failed. Please verify the micromamba BLAST environment, local database files and web-server permissions.<br><br>命令输出：<pre>"
                    . htmlspecialchars($commandOutput ?? '无输出')
                    . "</pre>";
            }

            if (file_exists($queryFile)) {
                unlink($queryFile);
            }
            if (file_exists($outputFile)) {
                unlink($outputFile);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>Protein Sequence Similarity Search</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        textarea { width: 100%; min-height: 180px; padding: 10px; font-size: 14px; box-sizing: border-box; font-family: monospace; }
        .btn { display: inline-block; padding: 10px 16px; background: #2c3e50; color: white; text-decoration: none; border: none; border-radius: 6px; cursor: pointer; margin-top: 10px; }
        .btn:hover { opacity: 0.9; }
        .message-success { background: #eafaf1; color: #1e8449; padding: 12px; border-radius: 6px; margin-top: 15px; }
        .message-error { background: #fdecea; color: #c0392b; padding: 12px; border-radius: 6px; margin-top: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: white; font-size: 14px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; vertical-align: top; }
        th { background: #f0f0f0; }
        .note { color: #666; font-size: 14px; }
        pre { white-space: pre-wrap; word-break: break-all; }
    </style>
</head>
<body>
    <?php $pageTitle = 'Protein Sequence Similarity Search'; include 'includes/header.php'; ?>
    <main>
        <section class="card">
            <p class="eyebrow">Local BLASTP module</p>
            <h2>Protein Sequence Similarity Search</h2>
            <p class="note">输入一段蛋白序列后，系统将在由 20 个 UniProt 免疫相关蛋白构建的本地 BLASTP 数据库中进行相似性检索。命中结果可直接跳转到对应基因详情页。</p>
            <form method="POST" action="blast.php">
                <label for="sequence"><strong>Query protein sequence</strong></label>
                <textarea name="sequence" id="sequence" placeholder="Paste an amino-acid sequence fragment, e.g. an IL6 peptide segment"><?php echo htmlspecialchars($_POST['sequence'] ?? ''); ?></textarea>
                <button type="submit" class="btn">Run BLASTP Search</button>
            </form>
            <?php if ($message !== ''): ?><div class="message-success"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
            <?php if ($error !== ''): ?><div class="message-error"><?php echo $error; ?></div><?php endif; ?>
        </section>

        <?php if (count($results) > 0): ?>
            <section class="card">
                <h2>BLASTP Results</h2>
                <table>
                    <tr>
                        <th>Query</th>
                        <th>Subject hit</th>
                        <th>Identity (%)</th>
                        <th>Alignment length</th>
                        <th>E-value</th>
                        <th>Bit score</th>
                        <th>Linked profile</th>
                    </tr>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['qseqid']); ?></td>
                            <td><?php echo htmlspecialchars($row['sseqid']); ?></td>
                            <td><?php echo htmlspecialchars($row['pident']); ?></td>
                            <td><?php echo htmlspecialchars($row['length']); ?></td>
                            <td><?php echo htmlspecialchars($row['evalue']); ?></td>
                            <td><?php echo htmlspecialchars($row['bitscore']); ?></td>
                            <td>
                                <?php if (!empty($row['matched_gene'])): ?>
                                    <a href="gene.php?id=<?php echo htmlspecialchars((string)$row['matched_gene']['id']); ?>">
                                        Open <?php echo htmlspecialchars($row['matched_gene']['gene_symbol']); ?>
                                    </a>
                                <?php else: ?>
                                    No local gene profile was mapped for this hit
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </section>
        <?php endif; ?>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
