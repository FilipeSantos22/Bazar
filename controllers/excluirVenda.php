<?php
require_once __DIR__ . '/../models/Venda.php';

// Verificar se o ID da venda foi fornecido
if (isset($_GET['id'])) {
    $idVenda = $_GET['id'];

    $venda = new Venda();
    $venda->id = $idVenda;

    $venda->excluirVenda();
    
    header('Location: https://bazarirc.com/view/listarVendas.php?status=success');
    exit;
} else {
    header('Location: https://bazarirc.com/controllers/listarVendas.php?status=error');
    exit;
}
