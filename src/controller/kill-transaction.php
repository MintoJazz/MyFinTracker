<?php require_once __DIR__ . '/../model/DAO.php';

$id        = $_POST['delete-id'];
$bucket_id = $_POST['bucket_id'];

$db = new SQLite3(__DIR__ . '/../../database.db');
$transactionDAO = new DAO('transaction');

$transactionDAO->killManyByKey($db, 'id', $id);
header("Location: /bucket/find.php?id=" . intval($bucket_id));
exit;
