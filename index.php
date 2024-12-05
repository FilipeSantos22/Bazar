<?php
include __DIR__.'/models/Produto.php';
include_once __DIR__.'/models/Venda.php';

$produtos = Produto::getProdutos();

include __DIR__.'/view/assets/css/style.php';
include __DIR__.'/view/head.php';
include __DIR__.'/view/header.php';
include __DIR__.'/view/listagemProduto.php';
include __DIR__.'/view/footer.php';
?>
