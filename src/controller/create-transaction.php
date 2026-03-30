<?php require_once __DIR__ . '/process-transaction.php';

if (!empty($erros)) {
    require __DIR__ . '/../../transaction/create.php';
    exit;
} else try {
    $dadosParaSalvar = [
        'description' => $data['description'],
        'amount'      => (int) $data['amount'],
        'date'        => $data['date'],
        'bucket_id'   => $data['bucket_id'],
    ];

    $transactionDAO->create($db, $dadosParaSalvar);

    header('Location: /bucket/find.php?id=' . $data['bucket_id']);
    exit;
} catch (Exception $e) {
    $erros['description'] = "Erro no banco de dados.";
    require __DIR__ . '/../../transaction/create.php';
    exit;
}
