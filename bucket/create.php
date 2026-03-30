<?php ob_start(); ?>

<div class="flex justify-center items-center h-screen">
    <form action="/src/controller/create-bucket.php" method="POST" class="border p-3 border-zinc-800 rounded-2xl flex flex-col gap-4 w-md">
        <div class="text-xl font-bold">Novo Bucket</div>
        <?php include __DIR__ . "/../src/view/BucketForm.php" ?>
    </form>
</div>

<?php

$children = ob_get_clean();

include __DIR__ . '/../src/view/PageRender.php';
