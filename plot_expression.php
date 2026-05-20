<?php
require_once __DIR__ . '/config/db.php';

$geneId = (int)($_GET['gene_id'] ?? 0);

if ($geneId <= 0) {
    header('Content-Type: text/plain; charset=utf-8');
    exit('Invalid gene_id');
}

$micromambaPath = '/home/hantao/.local/bin/micromamba';
$micromambaRoot = '/spaces/funny/micromamba';
$micromambaEnv = 'han_class';
$rPlotScript = __DIR__ . '/script/plot_expression.R';
$tmpDir = __DIR__ . '/tmp';
$micromambaHome = $tmpDir . '/mamba-home';

if (!is_dir($tmpDir)) {
    mkdir($tmpDir, 0775, true);
}
if (!is_dir($micromambaHome)) {
    mkdir($micromambaHome, 0777, true);
}

try {
    $geneStmt = $pdo->prepare("
        SELECT id, gene_symbol
        FROM genes
        WHERE id = :id
    ");
    $geneStmt->execute([':id' => $geneId]);
    $gene = $geneStmt->fetch();

    if (!$gene) {
        header('Content-Type: text/plain; charset=utf-8');
        exit('Gene not found');
    }

    $stmt = $pdo->prepare("
        SELECT
            g.gene_symbol,
            s.sample_name,
            s.tissue,
            s.condition_name,
            e.expression_value,
            e.expression_unit
        FROM expression e
        INNER JOIN genes g ON e.gene_id = g.id
        INNER JOIN samples s ON e.sample_id = s.id
        WHERE e.gene_id = :gene_id
        ORDER BY s.tissue ASC, s.sample_name ASC
    ");
    $stmt->execute([':gene_id' => $geneId]);
    $rows = $stmt->fetchAll();

    $uniqueId = uniqid('expr_', true);
    $inputTsv = $tmpDir . '/' . $uniqueId . '_input.tsv';
    $outputPng = $tmpDir . '/' . $uniqueId . '_plot.png';

    $fp = fopen($inputTsv, 'w');
    fwrite($fp, "gene_symbol\tsample_name\ttissue\tcondition_name\texpression_value\texpression_unit\n");

    foreach ($rows as $row) {
        $line = [
            $row['gene_symbol'] ?? '',
            $row['sample_name'] ?? '',
            $row['tissue'] ?? '',
            $row['condition_name'] ?? '',
            $row['expression_value'] ?? '',
            $row['expression_unit'] ?? ''
        ];

        $escaped = array_map(function ($value) {
            return str_replace(["\t", "\n", "\r"], ' ', (string)$value);
        }, $line);

        fwrite($fp, implode("\t", $escaped) . "\n");
    }

    fclose($fp);

    $cmd = 'HOME=' . escapeshellarg($micromambaHome)
        . ' MAMBA_ROOT_PREFIX=' . escapeshellarg($micromambaRoot)
        . ' ' . escapeshellarg($micromambaPath)
        . ' run -n ' . escapeshellarg($micromambaEnv)
        . ' Rscript ' . escapeshellarg($rPlotScript)
        . ' ' . escapeshellarg($inputTsv)
        . ' ' . escapeshellarg($outputPng)
        . ' 2>&1';

    $commandOutput = shell_exec($cmd);

    if (!file_exists($outputPng) || filesize($outputPng) === 0) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "R plot generation failed.\n\n";
        echo "Command output:\n";
        echo $commandOutput ?? 'No output';
        if (file_exists($inputTsv)) {
            unlink($inputTsv);
        }
        exit;
    }

    header('Content-Type: image/png');
    readfile($outputPng);

    if (file_exists($inputTsv)) {
        unlink($inputTsv);
    }
    if (file_exists($outputPng)) {
        unlink($outputPng);
    }
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Database error: ' . $e->getMessage();
}
