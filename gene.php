<?php
require_once __DIR__ . '/config/db.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    die('缺少有效的基因ID');
}

$stmt = $pdo->prepare("
    SELECT
        id,
        gene_symbol,
        ensembl_id,
        uniprot_id,
        protein_name,
        species,
        gene_class,
        description,
        sequence_type,
        sequence,
        source_database,
        source_url
    FROM genes
    WHERE id = :id
");
$stmt->execute([':id' => $id]);
$gene = $stmt->fetch();

if (!$gene) {
    die('没有找到该基因记录');
}

$stmt2 = $pdo->prepare("
    SELECT
        s.sample_name,
        s.tissue,
        s.condition_name,
        e.expression_value,
        e.expression_unit
    FROM expression e
    INNER JOIN samples s ON e.sample_id = s.id
    WHERE e.gene_id = :gene_id
    ORDER BY s.tissue ASC, s.sample_name ASC
");
$stmt2->execute([':gene_id' => $id]);
$expressionData = $stmt2->fetchAll();
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($gene['gene_symbol']); ?> - Curated Gene Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        pre {
            white-space: pre-wrap;
            word-break: break-all;
            background: #f8f8f8;
            padding: 15px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: white;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px 20px;
        }

        @media (max-width: 720px) {
            .meta-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php
    $pageTitle = 'Curated Gene Profile';
    include 'includes/header.php';
    ?>

    <main>
        <section class="card">
            <p class="eyebrow">Curated gene profile</p>
            <h2><?php echo htmlspecialchars($gene['gene_symbol']); ?></h2>
            <div class="meta-grid">
                <p><strong>Ensembl ID:</strong> <?php echo htmlspecialchars($gene['ensembl_id'] ?? ''); ?></p>
                <p><strong>UniProt ID:</strong> <?php echo htmlspecialchars($gene['uniprot_id'] ?? ''); ?></p>
                <p><strong>Protein Name:</strong> <?php echo htmlspecialchars($gene['protein_name'] ?? ''); ?></p>
                <p><strong>Species:</strong> <?php echo htmlspecialchars($gene['species'] ?? ''); ?></p>
                <p><strong>Functional Class:</strong> <?php echo htmlspecialchars($gene['gene_class'] ?? ''); ?></p>
                <p><strong>Data Source:</strong> <?php echo htmlspecialchars($gene['source_database'] ?? ''); ?></p>
            </div>
            <p><strong>Annotation:</strong> <?php echo htmlspecialchars($gene['description'] ?? ''); ?></p>
            <?php if (!empty($gene['source_url'])): ?>
                <p><strong>Reference URL:</strong> <?php echo htmlspecialchars($gene['source_url']); ?></p>
            <?php endif; ?>
        </section>

        <section class="card">
            <h2>Protein Sequence</h2>
            <p><strong>Sequence Type:</strong> <?php echo htmlspecialchars($gene['sequence_type'] ?? ''); ?> sequence retrieved from UniProtKB.</p>
            <pre><?php echo htmlspecialchars($gene['sequence'] ?? ''); ?></pre>
        </section>

        <section class="card">
            <h2>Immune-cell RNA Expression</h2>
            <?php if (count($expressionData) > 0): ?>
                <table>
                    <tr>
                        <th>Immune-cell profile</th>
                        <th>Profile label</th>
                        <th>Condition</th>
                        <th>Expression value</th>
                        <th>Unit</th>
                    </tr>
                    <?php foreach ($expressionData as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['sample_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['tissue'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['condition_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars((string)($row['expression_value'] ?? '')); ?></td>
                            <td><?php echo htmlspecialchars($row['expression_unit'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No immune-cell expression records are currently available for this gene.</p>
            <?php endif; ?>
        </section>

        <?php if (count($expressionData) > 0): ?>
            <section class="card">
                <h2>Immune-cell Expression Profile</h2>
                <img
                    class="plot-frame"
                    src="plot_expression.php?gene_id=<?php echo htmlspecialchars((string)$gene['id']); ?>"
                    alt="Expression Plot">
            </section>
        <?php endif; ?>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
