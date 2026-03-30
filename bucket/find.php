<?php ob_start();

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/model/DAO.php';

$iconManager = new Lucide\IconManager();
$db = new SQLite3(__DIR__ . '/../database.db');
$bucketDAO = new DAO('bucket');
$transactionDAO = new DAO('transaction');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /index.php');
    exit;
}

$bucket = $bucketDAO->findOneByKey($db, 'id', $id);

if (!$bucket) {
    header('Location: /index.php');
    exit;
}

$transactions = $transactionDAO->findManyByKey($db, 'bucket_id', $id);

?>

<?php include __DIR__ . '/../src/view/BucketProfile.php'; ?>

<?php

$children = ob_get_clean();

include __DIR__ . '/../src/view/PageRender.php';
