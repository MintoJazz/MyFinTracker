<?php
require_once __DIR__ . '/../model/DAO.php';

$db = new SQLite3(__DIR__ . '/../../database.db');
$transactionDAO = new DAO('transaction');

$data = [
    'description' => trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS)),
    'amount'      => filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_SPECIAL_CHARS),
    'date'        => trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS)),
    'bucket_id'   => filter_input(INPUT_POST, 'bucket_id', FILTER_VALIDATE_INT),
];

$erros = [];

if (empty($data['description']))
    $erros['description'] = "O campo 'descrição' é obrigatório.";
elseif (mb_strlen($data['description'], 'UTF-8') > 200)
    $erros['description'] = "A descrição não pode ultrapassar 200 caracteres.";

if ($data['amount'] === null || $data['amount'] === '')
    $erros['amount'] = "O campo 'valor' é obrigatório.";
elseif (!preg_match('/^-?[0-9]+$/', (string) $data['amount']))
    $erros['amount'] = "O valor deve ser um número válido.";

if (empty($data['date']))
    $erros['date'] = "O campo 'data' é obrigatório.";

if (!$data['bucket_id'])
    $erros['bucket_id'] = "Bucket inválido.";
