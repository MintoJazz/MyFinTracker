<?php require_once __DIR__ . '/process-transaction.php';

$id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
if (!$id) $erros['id'] = "Requisição inválida";

if (!empty($erros)) {
    require __DIR__ . '/../../transaction/update.php';
    exit;
} else try {
    $dadosParaSalvar = [
        'description' => $data['description'],
        'amount'      => (int) $data['amount'],
        'date'        => $data['date'],
    ];

    $transactionDAO->updateManyByKey($db, $dadosParaSalvar, 'id', $id);

    $transaction = $transactionDAO->findOneByKey($db, 'id', $id);
    header('Location: /bucket/find.php?id=' . $transaction['bucket_id']);
    exit;
} catch (Exception $e) {
    $erros['description'] = "Erro no banco de dados.";
    require __DIR__ . '/../../transaction/update.php';
    exit;
}
