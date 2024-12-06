<?php
require __DIR__ . '/../models/Produto.php';

// Verifica se o ID foi passado via GET e se é numérico
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: https://bazarirc.com/index.php?status=error');
    exit;
}

$obProduto = Produto::getProduto($_GET['id']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: https://bazarirc.com/index.php?status=error');
    exit;
}

if(!$obProduto instanceof Produto) {
    header('Location: https://bazarirc.com/index.php?status=error');
}    

if(isset($_POST['excluir'])) {
    
    $obProduto->excluir(); 
    header('Location: https://bazarirc.com/index.php?status=success');
    exit;   
}
include __DIR__.'/../view/assets/css/style.php';
include __DIR__.'/../view/head.php';
include __DIR__.'/../view/header.php';
include __DIR__.'/../view/confirmar-exclusao.php';
include __DIR__.'/../view/footer.php';
?>