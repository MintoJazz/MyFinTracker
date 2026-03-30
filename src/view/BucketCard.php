<?php

$icons = [
    'CREDITO' => $iconManager->getIcon('credit-card', ['width' => 18]),
    'CARTEIRA' => $iconManager->getIcon('wallet', ['width' => 18]),
    'RESERVA'  => $iconManager->getIcon('piggy-bank', ['width' => 18])
];

$labels = [
    'CREDITO' => 'Crédito',
    'CARTEIRA' => 'Carteira',
    'RESERVA'  => 'Reserva'
];

$txs    = $transactionDAO->findManyByKey($db, 'bucket_id', $bucket['id']);
$total  = array_sum(array_column($txs, 'amount'));
$count  = count($txs);
$totalFormatado   = 'R$ ' . number_format($total / 100, 2, ',', '.');
$totalPositivo    = $total >= 0;
$countLabel       = $count === 1 ? '1 transação' : "$count transações";

?>

<div class="group flex items-center justify-between border border-zinc-800 rounded-xl px-4 py-3 hover:bg-zinc-900 transition-colors">
    <a href="/bucket/find.php?id=<?= $bucket['id'] ?>" class="flex items-center gap-3 flex-1 min-w-0">
        <div class="text-zinc-400 shrink-0">
            <?= $icons[$bucket['tipo']] ?>
        </div>
        <div class="flex flex-col min-w-0">
            <p class="font-medium truncate"><?= htmlspecialchars($bucket['name']) ?></p>
            <p class="text-zinc-500 text-xs"><?= $labels[$bucket['tipo']] ?> · <?= $countLabel ?></p>
        </div>
    </a>

    <div class="flex items-center gap-4 ml-4 shrink-0">
        <span class="font-semibold text-sm <?= $totalPositivo ? 'text-zinc-100' : 'text-red-400' ?>">
            <?= $totalFormatado ?>
        </span>
        <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <form action="/src/controller/kill-bucket.php" method="POST">
                <input class="hidden" type="text" name="delete-id" value="<?= $bucket['id'] ?>">
                <button class="p-1.5 rounded-lg hover:bg-red-950 hover:text-red-400 text-zinc-500 transition-colors cursor-pointer">
                    <?= $iconManager->getIcon('trash-2', ['width' => 14]) ?>
                </button>
            </form>
            <form action="/bucket/update.php">
                <input type="hidden" name="name" value="<?= htmlspecialchars($bucket['name']) ?>">
                <input type="hidden" name="id"   value="<?= htmlspecialchars($bucket['id']) ?>">
                <input type="hidden" name="type"  value="<?= htmlspecialchars($bucket['tipo']) ?>">
                <button type="submit" class="p-1.5 rounded-lg hover:bg-zinc-700 text-zinc-500 hover:text-zinc-100 transition-colors cursor-pointer">
                    <?= $iconManager->getIcon('pencil', ['width' => 14]) ?>
                </button>
            </form>
        </div>
    </div>
</div>