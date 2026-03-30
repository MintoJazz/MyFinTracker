<?php require_once __DIR__ . '/process-bucket.php';

$id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
if (!$id) $erros['id'] = "Requisição inválida";

if (!empty($erros)) {
    require __DIR__ . '/../../bucket/update.php';
    exit;
} else try {
    $dadosParaSalvar = [
        'name' => $data['name'],
        'tipo' => $data['type']
    ];
    
    $bucketDAO->updateManyByKey($db, $dadosParaSalvar, 'id', $id);
    
    header('Location: /index.php');
    exit;
} catch (Exception $e) {
    $erros['name'] = "Erro no banco de dados.";
    require __DIR__ . '/../../bucket/update.php';
    exit;
}
