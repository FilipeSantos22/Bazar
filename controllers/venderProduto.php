<?php
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/Venda.php';


define('TITLE', 'Nova Venda');

$errorMessage = isset($_GET['mensagem']) ? $_GET['mensagem'] : '';

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
$obProduto = new Produto();
$obVenda = new Venda();

if(isset($_GET['id'])) {

    $obVenda = new Venda();
    $produto = $obProduto->getProduto($_GET['id']);
    $obVenda->setPreco($produto->preco);
    $obVenda->cadastrar();
    $obProduto->atualizarEstoque($produto->id);
    $obVenda->setItensVendidos($_GET['id']);

}

include __DIR__.'/../view/head.php';
include __DIR__.'/../view/assets/css/style.php';
include __DIR__.'/../view/header.php';
include __DIR__.'/../view/form.php';
include __DIR__.'/../view/footer.php';
?>