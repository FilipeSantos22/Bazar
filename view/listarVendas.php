<?php
require_once __DIR__ . '/head.php';
require_once __DIR__ . '/assets/css/style.php';
require_once __DIR__ . '/../library/Connection.php';
require_once __DIR__ . '/../models/Venda.php';
include __DIR__.'/header.php';

$mensagem = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        $mensagem = '<div class="alert alert-success text-center">Venda excluída com sucesso!</div>';
    } elseif ($_GET['status'] === 'error') {
        $mensagem = '<div class="alert alert-danger text-center">Erro ao excluir venda!</div>';
    }
}

// Obter as vendas não excluídas
$vendas = Venda::getVendas('is_deleted = FALSE'); // Filtrar vendas não excluídas
?>

<section>
    <div class="container-fluid" style="max-height: 600px; max-width: 70%; overflow-y: auto;">
        <h2 class="text-center mb-4">Vendas Registradas</h2>
        <a href="https://bazarirc.com//index.php">
            <div class="btn btn-primary m3-3 ">Ver Produtos</div>
        </a> 
        
        <?= $mensagem ?>

        <table class="table table-striped bg-color">
            <thead>
                <tr class="bg-color">
                    <th scope="col" class="table_color text-light">ID</th>
                    <th scope="col" class="table_color text-light">Valor da Venda</th>
                    <th scope="col" class="table_color text-light">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendas as $venda): ?>
                    <tr>
                        <td><?= $venda->id ?></td>
                        <td>
                            <?php
                            // Garantir que o valor de total_arrecadado seja convertido para float antes de formatar
                            $totalArrecadado = (float) str_replace(',', '.', $venda->getTotalArrecadado());
                            echo 'R$ ' . number_format($totalArrecadado, 2, ',', '.');
                            ?>
                        </td>
                        <td>
                            <!-- Botão de excluir venda -->
                            <a href="https://bazarirc.com/controllers/excluirVenda.php?id=<?= $venda->id ?>" class="btn btn-danger">
                                Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div>
  
</section>
</body>
