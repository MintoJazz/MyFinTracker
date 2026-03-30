<?php ob_start();

require __DIR__ .  '/vendor/autoload.php';
require_once __DIR__ . '/src/model/DAO.php';

$iconManager = new Lucide\IconManager();

$db = new SQLite3('./database.db');
$bucketDAO     = new DAO('bucket');
$transactionDAO = new DAO('transaction');

$buckets = $bucketDAO->findAll($db);

// Calcula saldo total de todas as transações
$totalGeral = 0;
foreach ($buckets as $b) {
    $txs = $transactionDAO->findManyByKey($db, 'bucket_id', $b['id']);
    foreach ($txs as $tx) $totalGeral += $tx['amount'];
}

$totalFormatado = 'R$ ' . number_format($totalGeral / 100, 2, ',', '.');
$totalPositivo  = $totalGeral >= 0;

?>

<div class="max-w-2xl mx-auto flex flex-col gap-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <?= $iconManager->getIcon('landmark', ['width' => 22, 'class' => 'text-zinc-400']) ?>
            <span class="text-xl font-bold tracking-tight">MyFinTracker</span>
        </div>
        <a href="./bucket/create.php"
           class="h-8 px-3 cursor-pointer bg-zinc-50 rounded-lg flex gap-2 items-center font-bold text-sm text-zinc-900 hover:bg-zinc-200 transition-colors">
            <?= $iconManager->getIcon('circle-plus', ['width' => 16]) ?>
            Novo Bucket
        </a>
    </div>

    <!-- Saldo total -->
    <div class="rounded-2xl border border-zinc-800 bg-zinc-900 px-5 py-4 flex items-center justify-between">
        <div>
            <p class="text-xs text-zinc-500 uppercase tracking-widest mb-1">Saldo total</p>
            <p class="text-2xl font-bold <?= $totalPositivo ? 'text-zinc-50' : 'text-red-400' ?>">
                <?= $totalFormatado ?>
            </p>
        </div>
        <div class="text-zinc-700">
            <?= $iconManager->getIcon('wallet', ['width' => 32]) ?>
        </div>
    </div>

    <!-- Lista de buckets -->
    <div class="flex flex-col gap-1">
        <p class="text-xs text-zinc-500 uppercase tracking-widest mb-1">Buckets</p>
        <?php include_once __DIR__ . "/src/view/BucketList.php"; ?>
    </div>

</div>

<?php
$children = ob_get_clean();
include __DIR__ . "/src/view/PageRender.php";
