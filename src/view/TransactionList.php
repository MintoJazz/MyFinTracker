<?php
if (empty($transactions)): ?>
    <div class="flex flex-col items-center justify-center py-12 text-zinc-500 gap-2">
        <?= $iconManager->getIcon('receipt', ['width' => 36]) ?>
        <p class="text-sm">Nenhuma transação encontrada</p>
    </div>
<?php else: ?>
    <div class="flex flex-col gap-2">
        <?php foreach ($transactions as $transaction) include __DIR__ . '/TransactionCard.php'; ?>
    </div>
<?php endif; ?>
