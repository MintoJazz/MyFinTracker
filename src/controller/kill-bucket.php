<?php require_once __DIR__ . '/../model/DAO.php';

$id = $_POST["delete-id"];

$db = new SQLite3(__DIR__ . '/../../database.db');
$bucketDAO = new DAO('bucket');

$bucketDAO->killManyByKey($db, 'id', $id);
header("Location: /index.php");
exit;
