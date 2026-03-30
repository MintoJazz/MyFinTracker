<?php
$data = [
    'id'          => $_GET['id']          ?? '',
    'description' => $_GET['description'] ?? '',
    'amount'      => $_GET['amount'] ?? '',
    'date'        => $_GET['date']        ?? date('Y-m-d'),
    'bucket_id'   => $_GET['bucket_id']   ?? '',
];
ob_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/model/DAO.php';

$iconManager = new Lucide\IconManager();
$db = new SQLite3(__DIR__ . '/../database.db');

$bucket_id = (int) $data['bucket_id'];
$bucketDAO = new DAO('bucket');
$bucket    = $bucketDAO->findOneByKey($db, 'id', $bucket_id);

if (!$bucket) {
    header('Location: /index.php');
    exit;
}

$erros = $erros ?? [];
?>

<div class="flex justify-center items-center h-screen">
    <form action="/src/controller/update-transaction.php" method="POST" class="border p-4 border-zinc-800 rounded-2xl flex flex-col gap-4 w-md">
        <div class="flex items-center gap-2">
            <a href="/bucket/find.php?id=<?= $bucket_id ?>" class="text-zinc-400 hover:text-zinc-50 transition-colors">
                <?= $iconManager->getIcon('arrow-left', ['width' => 18]) ?>
            </a>
            <div>
                <div class="text-xl font-bold">Editar Transação</div>
                <div class="text-zinc-400 text-sm"><?= htmlspecialchars($bucket['name']) ?></div>
            </div>
        </div>
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
        <input type="hidden" name="bucket_id" value="<?= htmlspecialchars($data['bucket_id']) ?>">
        <?php include __DIR__ . '/../src/view/TransactionForm.php'; ?>
    </form>
</div>

<?php

$children = ob_get_clean();

include __DIR__ . '/../src/view/PageRender.php';
