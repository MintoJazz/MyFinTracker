<?php require_once __DIR__ . '/process-bucket.php';

if (!empty($erros)) {
    require __DIR__ . '/../../bucket/create.php';
    exit;
} else try {
    $dadosParaSalvar = [
        'name' => $data['name'],
        'tipo' => $data['type']
    ];
    
    $bucketDAO->create($db, $dadosParaSalvar);

    header('Location: /index.php');
    exit;
} catch (Exception $e) {
    $erros['name'] = "Erro no banco de dados.";
    require __DIR__ . '/../../bucket/create.php';
    exit;
}
