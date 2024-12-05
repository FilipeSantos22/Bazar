<?php
require __DIR__ . '/../models/Produto.php';
define('TITLE', 'Editar Cadastro');

$obProduto = Produto::getProduto($_GET['id']);

if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('Location: /Bazar/index.php?status=error');
    exit;
}

if(!$obProduto instanceof Produto) {
    header('Location: /Bazar/index.php?status=error');
}

if(isset($_POST['nome'], $_POST['preco'], $_POST['quantidade'], $_POST['categoria'])) {
    
    $obProduto->setNome ($_POST['nome']);
    $obProduto->setPreco  ($_POST['preco']);
    $obProduto->setQuantidade ($_POST['quantidade']);
    $obProduto->setCategoria ($_POST['categoria']);
    $obProduto->atualizar(); 

    header('Location: /Bazar/index.php?status=success');
    exit;
}

include __DIR__.'/../view/assets/css/style.php';
include __DIR__.'/../view/head.php';
include __DIR__.'/../view/header.php';
include __DIR__.'/../view/form.php';
include __DIR__.'/../view/footer.php';
?>