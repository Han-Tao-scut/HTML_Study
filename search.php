<?php
require_once __DIR__ . '/config/db.php';

$keyword = trim($_GET['keyword'] ?? '');
$results = [];

if ($keyword !== '') {
    $sql = "
        SELECT
            id,
            gene_symbol,
            ensembl_id,
            protein_name,
            species,
            gene_class,
            description,
            source_database
        FROM genes
        WHERE gene_symbol LIKE :keyword
           OR ensembl_id LIKE :keyword
           OR protein_name LIKE :keyword
           OR species LIKE :keyword
           OR gene_class LIKE :keyword
           OR description LIKE :keyword
        ORDER BY gene_symbol ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);

    $results = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>Curated Gene Search</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .search-box {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .search-box input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
        }

        .search-box button {
            padding: 10px 16px;
            font-size: 16px;
            cursor: pointer;
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

        .actions {
            white-space: nowrap;
        }

        .actions a {
            margin-right: 10px;
            color: #2c3e50;
            font-weight: bold;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .message {
            margin-top: 15px;
            color: #666;
        }
    </style>
</head>

<body>
    <?php
    $pageTitle = 'Curated Gene Search';
    include 'includes/header.php';
    ?>

    <main>
        <section class="card">
            <p class="eyebrow">Gene-level retrieval</p>
            <h2>Curated Gene Search</h2>
            <p>支持 gene symbol、Ensembl ID、蛋白名称、物种、功能类别和注释关键词，例如 IL6、Homo sapiens、cytokine 或 Toll-like receptor。</p>

            <form method="GET" action="search.php">
                <div class="search-box">
                    <input
                        type="text"
                        name="keyword"
                        placeholder="Search by gene, Ensembl ID, protein, class, or annotation"
                        value="<?php echo htmlspecialchars($keyword); ?>"
                        required>
                    <button type="submit">Search</button>
                </div>
            </form>

            <?php if ($keyword !== ''): ?>
                <div class="message">
                    Query term: <strong><?php echo htmlspecialchars($keyword); ?></strong>
                </div>

                <?php if (count($results) > 0): ?>
                    <div class="message"><?php echo count($results); ?> matching curated record(s) found.</div>

                    <table>
                        <tr>
                            <th>Gene Symbol</th>
                            <th>Ensembl ID</th>
                            <th>Species</th>
                            <th>Functional class</th>
                            <th>Source</th>
                            <th>Actions</th>
                        </tr>
                        <?php foreach ($results as $gene): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($gene['gene_symbol']); ?></td>
                                <td><?php echo htmlspecialchars($gene['ensembl_id'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($gene['species'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($gene['gene_class'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($gene['source_database'] ?? ''); ?></td>
                                <td class="actions">
                                    <a href="gene.php?id=<?php echo htmlspecialchars((string)$gene['id']); ?>">View</a>
                                    <a href="admin.php?action=edit&id=<?php echo htmlspecialchars((string)$gene['id']); ?>">Edit</a>
                                    <a href="admin.php?action=delete&id=<?php echo htmlspecialchars((string)$gene['id']); ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <div class="message">No curated gene matched the current query.</div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>