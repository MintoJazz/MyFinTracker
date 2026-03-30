<?php

$icons = [
    'CREDITO' => $iconManager->getIcon('credit-card', ['width' => 32, 'height' => 32]),
    'CARTEIRA' => $iconManager->getIcon('wallet', ['width' => 32, 'height' => 32]),
    'RESERVA' => $iconManager->getIcon('piggy-bank', ['width' => 32, 'height' => 32])
];

$labels = [
    'CREDITO' => 'Crédito',
    'CARTEIRA' => 'Carteira',
    'RESERVA' => 'Reserva'
];

?>

<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="/index.php" class="text-zinc-400 hover:text-zinc-50 transition-colors">
                <?= $iconManager->getIcon('arrow-left', ['width' => 20]) ?>
            </a>
            <div class="flex items-center gap-3">
                <div class="text-zinc-300">
                    <?= $icons[$bucket['tipo']] ?>
                </div>
                <div>
                    <h1 class="text-2xl font-bold"><?= htmlspecialchars($bucket['name']) ?></h1>
                    <p class="text-zinc-400 text-sm"><?= $labels[$bucket['tipo']] ?></p>
                </div>
            </div>
        </div>
        <div class="flex gap-2">
            <form action="/bucket/update.php" method="GET">
                <input type="hidden" name="id" value="<?= $bucket['id'] ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($bucket['name']) ?>">
                <input type="hidden" name="type" value="<?= htmlspecialchars($bucket['tipo']) ?>">
                <button type="submit" class="cursor-pointer h-8 px-3 bg-zinc-800 rounded-lg flex gap-2 items-center text-sm hover:bg-zinc-700 transition-colors">
                    <?= $iconManager->getIcon('pencil', ['width' => 14]) ?>
                    Editar
                </button>
            </form>
            <form action="/src/controller/kill-bucket.php" method="POST">
                <input type="hidden" name="delete-id" value="<?= $bucket['id'] ?>">
                <button type="submit" class="cursor-pointer h-8 px-3 bg-red-950 text-red-400 rounded-lg flex gap-2 items-center text-sm hover:bg-red-900 transition-colors">
                    <?= $iconManager->getIcon('trash-2', ['width' => 14]) ?>
                    Excluir
                </button>
            </form>
        </div>
    </div>

    <div class="border-t border-zinc-800"></div>

    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold">Transações</h2>
        <a href="/transaction/create.php?bucket_id=<?= $bucket['id'] ?>"
           class="cursor-pointer h-8 px-3 bg-zinc-50 text-zinc-900 rounded-lg flex gap-2 items-center text-sm font-bold hover:bg-zinc-200 transition-colors">
            <?= $iconManager->getIcon('circle-plus', ['width' => 16]) ?>
            Nova Transação
        </a>
    </div>

    <?php include __DIR__ . '/TransactionList.php'; ?>
</div>
