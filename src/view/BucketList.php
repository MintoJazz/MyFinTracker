<?php if (empty($buckets)): ?>
    <div class="flex flex-col items-center justify-center py-16 text-zinc-600 gap-3">
        <?= $iconManager->getIcon('folder-open', ['width' => 40]) ?> 
        <p class="text-sm">Nenhum bucket criado ainda.</p>
        <a href="./bucket/create.php" class="text-xs text-zinc-400 hover:text-zinc-50 underline transition-colors">
            Criar primeiro bucket
        </a>
    </div>
<?php else: ?>
    <div class="flex flex-col gap-1">
        <?php foreach ($buckets as $bucket) include __DIR__ . '/BucketCard.php'; ?>
    </div>
<?php endif; ?>
