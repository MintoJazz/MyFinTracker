<?php
require_once './src/controller/DAO.php';

$db = new SQLite3('./database.db');
$bucketDAO = new DAO('bucket');

foreach ($bucketDAO->findAll($db) as $bucket) include './src/components/BucketCard.php';