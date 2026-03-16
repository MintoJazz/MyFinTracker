<?php 

require_once '../model/Bucket.php';

function BucketCard(Bucket $bucket) {
    $nome = $bucket->getName();

    $html = <<<EOT
<p> $nome </p> 
EOT;

    return  $html;
}