<?php
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/Venda.php';

define('TITLE', 'Inserir Produto');

$errorMessage = isset($_GET['mensagem']) ? $_GET['mensagem'] : '';

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
$obProduto = new Produto();
$obEndereco = new Venda();

if(isset($_POST['nome'], $_POST['preco'], $_POST['quantidade']/*, $_POST['categoria']*/)) {
    
    $obProduto = new Produto();
    
    $obProduto->setNome ($_POST['nome']);
    $obProduto->setPreco  ($_POST['preco']);
    $obProduto->setQuantidade ($_POST['quantidade']);
    // $obProduto->setCategoria ($_POST['categoria']);

    $obProduto->cadastrar();            
    sleep(2);
    header('Location: /Bazar/index.php?status=success');
    exit;   

}

include __DIR__.'/../view/head.php';
include __DIR__.'/../view/assets/css/style.php';
include __DIR__.'/../view/header.php';
include __DIR__.'/../view/form.php';
include __DIR__.'/../view/footer.php';
?>