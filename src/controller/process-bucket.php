<?php
require_once __DIR__ . '/../model/DAO.php';

$db = new SQLite3(__DIR__ . '/../../database.db');
$bucketDAO = new DAO('bucket');

$data = [
    'name' => trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS)),
    'type' => trim(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS))
];

$erros = [];

if (empty($data['name'])) $erros['name'] = "O campo 'name' é obrigatório.";
elseif (mb_strlen($data['name'], 'UTF-8') > 100) $erros['name'] = "O 'name' não pode ultrapassar 100 caracteres.";

$tiposPermitidos = ['CARTEIRA', 'CREDITO', 'RESERVA'];

if (empty($data['type'])) $erros['type'] = "O campo 'type' é obrigatório.";
elseif (!in_array($data['type'], $tiposPermitidos, true)) $erros['type'] = "O 'tipo' selecionado é inválido. Valores aceitos: Carteira, Crédito ou Reserva.";
