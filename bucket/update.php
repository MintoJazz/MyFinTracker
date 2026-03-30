<?php
$data = [
    'id'   => $_GET['id']   ?? '',
    'name' => $_GET['name'] ?? '',
    'type' => $_GET['type'] ?? ''
];
ob_start();
?>

<div class="flex justify-center items-center h-screen">
    <form action="/src/controller/update-bucket.php" method="POST" class="border p-3 border-zinc-800 rounded-2xl flex flex-col gap-4 w-md">
        <div class="text-xl font-bold">Editar Bucket</div>
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
        <?php include __DIR__ . "/../src/view/BucketForm.php" ?>
    </form>
</div>

<?php

$children = ob_get_clean();

include __DIR__ . '/../src/view/PageRender.php';
