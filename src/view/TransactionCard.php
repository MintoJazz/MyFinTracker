<?php
$amountFormatted = 'R$ ' . number_format($transaction['amount'] / 100, 2, ',', '.');
$dateFormatted   = date('d/m/Y', strtotime($transaction['date']));
?>

<div class="group flex gap-4 border-zinc-800 border p-2 px-4 rounded-xl items-center justify-between">
    <div class="flex flex-col gap-0.5">
        <p class="font-medium"><?= htmlspecialchars($transaction['description']) ?></p>
        <p class="text-zinc-400 text-sm"><?= $dateFormatted ?></p>
    </div>
    <div class="flex items-center gap-4">
        <span class="font-semibold text-zinc-100"><?= $amountFormatted ?></span>
        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <form action="/transaction/update.php" method="GET">
                <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                <input type="hidden" name="description" value="<?= htmlspecialchars($transaction['description']) ?>">
                <input type="hidden" name="amount" value="<?= $transaction['amount'] ?>">
                <input type="hidden" name="date" value="<?= $transaction['date'] ?>">
                <input type="hidden" name="bucket_id" value="<?= $transaction['bucket_id'] ?>">
                <button type="submit"><?= $iconManager->getIcon('pencil', ['width' => 15]) ?></button>
            </form>
            <form action="/src/controller/kill-transaction.php" method="POST">
                <input type="hidden" name="delete-id" value="<?= $transaction['id'] ?>">
                <input type="hidden" name="bucket_id" value="<?= $transaction['bucket_id'] ?>">
                <button type="submit"><?= $iconManager->getIcon('trash-2', ['width' => 15]) ?></button>
            </form>
        </div>
    </div>
</div>
