<?php
require_once __DIR__ . '/config/db.php';

$countRows = $pdo->query("SELECT table_name, record_count FROM view_dataset_counts")->fetchAll();
$datasetCounts = [];
foreach ($countRows as $row) {
    $datasetCounts[$row['table_name']] = (int)$row['record_count'];
}

$speciesCount = (int)$pdo->query("SELECT COUNT(*) FROM view_species_summary")->fetchColumn();
$pageTitle = 'Longevity Microbiome & Immune Gene Resource';
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Longevity Microbiome & Immune Gene Resource</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="card">
            <p class="eyebrow">Introduction</p>
            <p>
                本研究主要围绕百岁老人肠道微生物组的生态重构展开，同时整合一个面向人类免疫调控基因的表达与序列资源及配套工具。
            </p>
            <p>
                数据库收录了 20 个代表性人类免疫相关基因，整合 Human Protein Atlas 免疫细胞 RNA 表达数据与 UniProt 蛋白注释，
                支持基因检索、表达谱浏览、序列比对和在线数据维护。
            </p>
        </section>

        <section class="card">
            <h2>Resource Snapshot</h2>
            <ul>
                <li>Species represented: <?php echo htmlspecialchars((string)$speciesCount); ?></li>
                <li>Curated immune genes: <?php echo htmlspecialchars((string)($datasetCounts['genes'] ?? 0)); ?></li>
                <li>Immune cell profiles: <?php echo htmlspecialchars((string)($datasetCounts['samples'] ?? 0)); ?></li>
                <li>Expression measurements: <?php echo htmlspecialchars((string)($datasetCounts['expression'] ?? 0)); ?></li>
            </ul>
        </section>

        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>