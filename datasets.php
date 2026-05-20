<?php
require_once __DIR__ . '/config/db.php';

try {
    $countRows = $pdo->query("SELECT table_name, record_count FROM view_dataset_counts")->fetchAll();
    $datasetCounts = [];
    foreach ($countRows as $row) {
        $datasetCounts[$row['table_name']] = (int) $row['record_count'];
    }

    $speciesList = $pdo->query("
        SELECT species, gene_count
        FROM view_species_summary
        ORDER BY species ASC
    ")->fetchAll();

    $geneClassList = $pdo->query("
        SELECT gene_class, gene_count
        FROM view_gene_class_summary
        ORDER BY gene_count DESC, gene_class ASC
    ")->fetchAll();

    $sourceList = $pdo->query("
        SELECT source_database, gene_count
        FROM view_source_summary
        ORDER BY gene_count DESC, source_database ASC
    ")->fetchAll();

    $expressionUnits = $pdo->query("
        SELECT expression_unit, COUNT(*) AS record_count
        FROM expression
        GROUP BY expression_unit
        ORDER BY expression_unit ASC
    ")->fetchAll();
} catch (PDOException $e) {
    die("读取数据失败：" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>Immune Gene Data Resource</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
        }

        .summary-item {
            background: #f8f9fb;
            border-radius: 8px;
            padding: 15px;
            border: 1px solid #ddd;
        }

        .summary-item h3 {
            margin: 0 0 10px 0;
            font-size: 16px;
        }

        .summary-item p {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .split-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
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
            vertical-align: top;
        }

        th {
            background: #f0f0f0;
        }

        .note {
            color: #666;
        }

        @media (max-width: 720px) {

            .summary-grid,
            .split-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php
    $pageTitle = 'Immune Gene Data Resource';
    include 'includes/header.php';
    ?>

    <main>
        <section class="card">
            <p class="eyebrow">Curated data layer</p>
            <h2>Resource Overview</h2>
            <p>
                构建了一个以人类免疫调控基因为核心的 curated resource，整合免疫细胞 RNA 表达谱、蛋白注释和可检索蛋白序列，
                用于支持基因层面的查询、可视化和序列相似性检索。
            </p>

            <div class="summary-grid">
                <div class="summary-item">
                    <h3>Curated genes</h3>
                    <p><?php echo htmlspecialchars((string)($datasetCounts['genes'] ?? 0)); ?></p>
                </div>
                <div class="summary-item">
                    <h3>Immune-cell profiles</h3>
                    <p><?php echo htmlspecialchars((string)($datasetCounts['samples'] ?? 0)); ?></p>
                </div>
                <div class="summary-item">
                    <h3>TPM measurements</h3>
                    <p><?php echo htmlspecialchars((string)($datasetCounts['expression'] ?? 0)); ?></p>
                </div>
            </div>
        </section>

        <section class="card">
            <h2>Data Sources and Curation</h2>

            <?php if (count($sourceList) > 0): ?>
                <table>
                    <tr>
                        <th>Source</th>
                        <th>Gene records</th>
                    </tr>
                    <?php foreach ($sourceList as $source): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($source['source_database']); ?></td>
                            <td><?php echo htmlspecialchars((string)$source['gene_count']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No source summary is currently available.</p>
            <?php endif; ?>
            <br>
            <p>
                表达数据来自 Human Protein Atlas immune cell RNA expression，筛选字段为 Ensembl gene identifier，并保留 TPM 作为 RNA-seq 表达量单位。
                蛋白名称、UniProt accession 和氨基酸序列来自 UniProtKB；二者通过预定义的 20 个免疫相关目标基因表进行整合。
            </p>
        </section>

        <section class="split-grid">
            <section class="card">
                <h2>Species Coverage</h2>
                <?php if (count($speciesList) > 0): ?>
                    <table>
                        <tr>
                            <th>Species</th>
                            <th>Gene records</th>
                        </tr>
                        <?php foreach ($speciesList as $species): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($species['species']); ?></td>
                                <td><?php echo htmlspecialchars((string)$species['gene_count']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p>No species summary is currently available.</p>
                <?php endif; ?>
            </section>

            <section class="card">
                <h2>Immune-cell Expression Matrix</h2>

                <?php if (count($expressionUnits) > 0): ?>
                    <table>
                        <tr>
                            <th>Expression unit</th>
                            <th>Records</th>
                        </tr>
                        <?php foreach ($expressionUnits as $unit): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($unit['expression_unit']); ?></td>
                                <td><?php echo htmlspecialchars((string)$unit['record_count']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p>No expression records are currently available.</p>
                <?php endif; ?>
            </section>
        </section>

        <section class="card">
            <h2>Functional Class Distribution</h2>
            <?php if (count($geneClassList) > 0): ?>
                <table>
                    <tr>
                        <th>Gene Class</th>
                        <th>Gene records</th>
                    </tr>
                    <?php foreach ($geneClassList as $geneClass): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($geneClass['gene_class']); ?></td>
                            <td><?php echo htmlspecialchars((string)$geneClass['gene_count']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No functional class summary is currently available.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>