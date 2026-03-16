<?php 
    require_once './controller/BucketDAO.php';
    require_once './components/bucketView.php';

    $db = new SQLite3('./database.db');
    $bucketDAO = new BucketDAO($db);

    foreach ($bucketDAO->findAll() as $bucket) echo BucketCard($bucket);
?>