<?php
require_once __DIR__ . '/../models/Venda.php'; 
include __DIR__.'/head.php';
include __DIR__.'/header.php';
include __DIR__.'/assets/css/style.php';

$mensagem = '';

$totalVendas = Venda::getTotalVendas();

?>

<body>
<div class="container-fluid"  style=" max-height: 600px; max-width: 70%; overflow-y: auto;">
        <h2 class="text-center">Total de Vendas</h2>
        
        <?php if ($mensagem): ?>
            <?= $mensagem ?>
        <?php endif; ?>

        <div class="text-center mt-4">
            <h3 class="text-center">Valor total de vendas realizadas: R$ <?= number_format($totalVendas, 2, ',', '.') ?></h3>
            <a href="/Bazar/index.php">
                <button class="btn btn-primary mt-3">Voltar ao Estoque</button>
            </a>
        </div>
    </div>
</body>
