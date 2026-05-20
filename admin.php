<?php
require_once __DIR__ . '/config/db.php';

$message = '';
$error = '';
$editMode = false;
$deleteMode = false;
$editGene = null;
$deleteGene = null;

function post_value(string $key): string
{
    return trim($_POST[$key] ?? '');
}

function gene_payload_from_post(): array
{
    return [
        'gene_symbol' => post_value('gene_symbol'),
        'ensembl_id' => post_value('ensembl_id'),
        'uniprot_id' => post_value('uniprot_id'),
        'protein_name' => post_value('protein_name'),
        'species' => post_value('species'),
        'gene_class' => post_value('gene_class'),
        'description' => post_value('description'),
        'sequence_type' => post_value('sequence_type'),
        'sequence' => post_value('sequence'),
        'source_database' => post_value('source_database'),
        'source_url' => post_value('source_url')
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
    $payload = gene_payload_from_post();

    if ($payload['gene_symbol'] === '' || $payload['species'] === '') {
        $error = 'Gene symbol 和 species 不能为空。';
    } else {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO genes (
                    gene_symbol, ensembl_id, uniprot_id, protein_name, species,
                    gene_class, description, sequence_type, sequence,
                    source_database, source_url
                ) VALUES (
                    :gene_symbol, :ensembl_id, :uniprot_id, :protein_name, :species,
                    :gene_class, :description, :sequence_type, :sequence,
                    :source_database, :source_url
                )
            ");
            $stmt->execute($payload);
            $message = '新基因记录添加成功。';
        } catch (PDOException $e) {
            $error = '添加失败：' . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update') {
    $id = (int)($_POST['id'] ?? 0);
    $payload = gene_payload_from_post();
    $payload['id'] = $id;

    if ($id <= 0 || $payload['gene_symbol'] === '' || $payload['species'] === '') {
        $error = '更新失败：请检查表单内容是否完整。';
    } else {
        try {
            $stmt = $pdo->prepare("
                UPDATE genes
                SET gene_symbol = :gene_symbol,
                    ensembl_id = :ensembl_id,
                    uniprot_id = :uniprot_id,
                    protein_name = :protein_name,
                    species = :species,
                    gene_class = :gene_class,
                    description = :description,
                    sequence_type = :sequence_type,
                    sequence = :sequence,
                    source_database = :source_database,
                    source_url = :source_url
                WHERE id = :id
            ");
            $stmt->execute($payload);
            $message = '基因记录更新成功。';
        } catch (PDOException $e) {
            $error = '更新失败：' . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $id = (int)($_POST['id'] ?? 0);

    if ($id <= 0) {
        $error = '删除失败：无效的基因ID。';
    } else {
        try {
            $stmt = $pdo->prepare("DELETE FROM genes WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $message = '基因记录删除成功。';
        } catch (PDOException $e) {
            $error = '删除失败：' . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'import_expression') {
    if (!isset($_FILES['expression_csv']) || $_FILES['expression_csv']['error'] !== UPLOAD_ERR_OK) {
        $error = '请上传有效的 expression CSV 文件。';
    } else {
        $tmpName = $_FILES['expression_csv']['tmp_name'];
        $originalName = $_FILES['expression_csv']['name'];
        $inserted = 0;
        $skipped = 0;

        try {
            $handle = fopen($tmpName, 'r');
            $header = fgetcsv($handle);
            $required = ['gene_symbol', 'sample_name', 'tissue', 'condition_name', 'expression_value', 'expression_unit'];

            if ($header === false || array_diff($required, $header)) {
                throw new RuntimeException('CSV 表头不正确。需要 gene_symbol,sample_name,tissue,condition_name,expression_value,expression_unit');
            }

            $index = array_flip($header);
            $pdo->beginTransaction();

            $geneStmt = $pdo->prepare("SELECT id, species FROM genes WHERE gene_symbol = :gene_symbol LIMIT 1");
            $sampleFindStmt = $pdo->prepare("SELECT id FROM samples WHERE sample_name = :sample_name LIMIT 1");
            $sampleInsertStmt = $pdo->prepare("
                INSERT INTO samples (sample_name, tissue, condition_name, species, source_database, description)
                VALUES (:sample_name, :tissue, :condition_name, :species, :source_database, :description)
            ");
            $exprStmt = $pdo->prepare("
                INSERT INTO expression (gene_id, sample_id, expression_value, expression_unit)
                VALUES (:gene_id, :sample_id, :expression_value, :expression_unit)
                ON DUPLICATE KEY UPDATE
                    expression_value = VALUES(expression_value),
                    expression_unit = VALUES(expression_unit)
            ");

            while (($row = fgetcsv($handle)) !== false) {
                $geneSymbol = trim($row[$index['gene_symbol']] ?? '');
                $sampleName = trim($row[$index['sample_name']] ?? '');
                $tissue = trim($row[$index['tissue']] ?? '');
                $conditionName = trim($row[$index['condition_name']] ?? '');
                $expressionValue = trim($row[$index['expression_value']] ?? '');
                $expressionUnit = trim($row[$index['expression_unit']] ?? 'TPM');

                if ($geneSymbol === '' || $sampleName === '' || $expressionValue === '' || !is_numeric($expressionValue)) {
                    $skipped++;
                    continue;
                }

                $geneStmt->execute([':gene_symbol' => $geneSymbol]);
                $gene = $geneStmt->fetch();
                if (!$gene) {
                    $skipped++;
                    continue;
                }

                $sampleFindStmt->execute([':sample_name' => $sampleName]);
                $sample = $sampleFindStmt->fetch();

                if ($sample) {
                    $sampleId = (int)$sample['id'];
                } else {
                    $sampleInsertStmt->execute([
                        ':sample_name' => $sampleName,
                        ':tissue' => $tissue,
                        ':condition_name' => $conditionName,
                        ':species' => $gene['species'],
                        ':source_database' => 'CSV import',
                        ':description' => 'Imported from expression CSV'
                    ]);
                    $sampleId = (int)$pdo->lastInsertId();
                }

                $exprStmt->execute([
                    ':gene_id' => $gene['id'],
                    ':sample_id' => $sampleId,
                    ':expression_value' => $expressionValue,
                    ':expression_unit' => $expressionUnit !== '' ? $expressionUnit : 'TPM'
                ]);
                $inserted++;
            }

            fclose($handle);

            $logStmt = $pdo->prepare("
                INSERT INTO import_logs (file_name, import_type, records_inserted, notes)
                VALUES (:file_name, 'expression_csv', :records_inserted, :notes)
            ");
            $logStmt->execute([
                ':file_name' => $originalName,
                ':records_inserted' => $inserted,
                ':notes' => 'Skipped rows: ' . $skipped
            ]);

            $pdo->commit();
            $message = '表达数据导入完成：成功处理 ' . $inserted . ' 行，跳过 ' . $skipped . ' 行。';
        } catch (Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            if (isset($handle) && is_resource($handle)) {
                fclose($handle);
            }
            $error = '导入失败：' . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? '') === 'edit') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare("SELECT * FROM genes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $editGene = $stmt->fetch();
        if ($editGene) {
            $editMode = true;
        } else {
            $error = '没有找到要编辑的基因记录。';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? '') === 'delete') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare("SELECT id, gene_symbol FROM genes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $deleteGene = $stmt->fetch();
        if ($deleteGene) {
            $deleteMode = true;
        } else {
            $error = '没有找到要删除的基因记录。';
        }
    }
}

$geneList = $pdo->query("
    SELECT id, gene_symbol, ensembl_id, protein_name, species, gene_class
    FROM genes
    ORDER BY id ASC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>Data Curation Console</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        form {
            margin-top: 15px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            font-size: 15px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-delete {
            background: #c0392b;
        }

        .btn-edit {
            background: #2980b9;
        }

        .message-success {
            background: #eafaf1;
            color: #1e8449;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .message-error {
            background: #fdecea;
            color: #c0392b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
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

        .inline-form {
            display: inline-block;
            margin: 0;
        }

        .action-cell {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .action-cell a,
        .action-cell form {
            margin-right: 0;
        }

        .note {
            color: #666;
        }

        @media (max-width: 720px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php
    $pageTitle = 'Data Curation Console';
    include 'includes/header.php';
    ?>

    <main>
        <?php if ($message !== ''): ?>
            <div class="message-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if ($error !== ''): ?>
            <div class="message-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($deleteMode): ?>
            <section class="card">
                <h2>Confirm Record Removal</h2>
                <p>Confirm removal of <strong><?php echo htmlspecialchars($deleteGene['gene_symbol']); ?></strong>?</p>
                <form method="POST" action="admin.php" class="inline-form">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)$deleteGene['id']); ?>">
                    <button type="submit" class="btn btn-delete">Remove Record</button>
                </form>
                <a href="admin.php" class="btn btn-secondary">Cancel</a>
            </section>
        <?php endif; ?>

        <section class="card">
            <p class="eyebrow">Manual curation interface</p>
            <h2><?php echo $editMode ? 'Edit Curated Gene Record' : 'Add Curated Gene Record'; ?></h2>
            <form method="POST" action="admin.php">
                <input type="hidden" name="action" value="<?php echo $editMode ? 'update' : 'add'; ?>">
                <?php if ($editMode): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)$editGene['id']); ?>">
                <?php endif; ?>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="gene_symbol">Gene Symbol</label>
                        <input type="text" id="gene_symbol" name="gene_symbol" required value="<?php echo htmlspecialchars($editMode ? $editGene['gene_symbol'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ensembl_id">Ensembl ID</label>
                        <input type="text" id="ensembl_id" name="ensembl_id" value="<?php echo htmlspecialchars($editMode ? $editGene['ensembl_id'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="uniprot_id">UniProt ID</label>
                        <input type="text" id="uniprot_id" name="uniprot_id" value="<?php echo htmlspecialchars($editMode ? $editGene['uniprot_id'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="protein_name">Protein annotation</label>
                        <input type="text" id="protein_name" name="protein_name" value="<?php echo htmlspecialchars($editMode ? $editGene['protein_name'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="species">Species</label>
                        <input type="text" id="species" name="species" required value="<?php echo htmlspecialchars($editMode ? $editGene['species'] : 'Homo sapiens'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="gene_class">Functional class</label>
                        <input type="text" id="gene_class" name="gene_class" value="<?php echo htmlspecialchars($editMode ? $editGene['gene_class'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="sequence_type">Sequence type</label>
                        <input type="text" id="sequence_type" name="sequence_type" value="<?php echo htmlspecialchars($editMode ? $editGene['sequence_type'] : 'protein'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="source_database">Data source</label>
                        <input type="text" id="source_database" name="source_database" value="<?php echo htmlspecialchars($editMode ? $editGene['source_database'] : ''); ?>">
                    </div>
                    <div class="form-group full">
                        <label for="source_url">Reference URL</label>
                        <input type="text" id="source_url" name="source_url" value="<?php echo htmlspecialchars($editMode ? $editGene['source_url'] : ''); ?>">
                    </div>
                    <div class="form-group full">
                        <label for="description">Annotation note</label>
                        <textarea id="description" name="description"><?php echo htmlspecialchars($editMode ? $editGene['description'] : ''); ?></textarea>
                    </div>
                    <div class="form-group full">
                        <label for="sequence">Protein sequence</label>
                        <textarea id="sequence" name="sequence"><?php echo htmlspecialchars($editMode ? $editGene['sequence'] : ''); ?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn"><?php echo $editMode ? 'Save Changes' : 'Add Gene Record'; ?></button>
                <?php if ($editMode): ?>
                    <a href="admin.php" class="btn btn-secondary">Cancel Editing</a>
                <?php endif; ?>
            </form>
        </section>

        <section class="card">
            <h2>Import Immune-cell Expression Matrix</h2>
            <p class="note">CSV import expects gene_symbol, sample_name, tissue, condition_name, expression_value and expression_unit. Imported rows are mapped to existing gene records by gene_symbol.</p>
            <form method="POST" action="admin.php" enctype="multipart/form-data">
                <input type="hidden" name="action" value="import_expression">
                <div class="form-group">
                    <label for="expression_csv">Expression CSV</label>
                    <input type="file" id="expression_csv" name="expression_csv" accept=".csv,text/csv" required>
                </div>
                <button type="submit" class="btn">Import Expression Matrix</button>
            </form>
        </section>

        <section class="card">
            <h2>Curated Gene Records</h2>
            <?php if (count($geneList) > 0): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Gene Symbol</th>
                        <th>Ensembl ID</th>
                        <th>Protein annotation</th>
                        <th>Species</th>
                        <th>Functional class</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($geneList as $gene): ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string)$gene['id']); ?></td>
                            <td><?php echo htmlspecialchars($gene['gene_symbol']); ?></td>
                            <td><?php echo htmlspecialchars($gene['ensembl_id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($gene['protein_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($gene['species'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($gene['gene_class'] ?? ''); ?></td>
                            <td class="action-cell">
                                <a class="btn btn-edit" href="admin.php?action=edit&id=<?php echo htmlspecialchars((string)$gene['id']); ?>">Edit</a>
                                <a class="btn btn-delete" href="admin.php?action=delete&id=<?php echo htmlspecialchars((string)$gene['id']); ?>">Remove</a>
                                <a class="btn" href="gene.php?id=<?php echo htmlspecialchars((string)$gene['id']); ?>">Open</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No curated gene records are currently available.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>