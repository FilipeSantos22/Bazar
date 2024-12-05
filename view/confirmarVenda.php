<?php
require_once __DIR__ . '/head.php';
require_once __DIR__ . '/assets/css/style.php';

$mensagem = '';
if (isset($_GET['venda'])) {
    if ($_GET['venda'] === 'success') {
        $mensagem = '<div class="alert alert-success text-center">Venda registrada com sucesso!</div>';
    } elseif ($_GET['venda'] === 'error') {
        $mensagem = '<div class="alert alert-danger text-center">Erro ao registrar venda!</div>';
    }
}
?>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Confirmação de Venda</h2>
        <?= $mensagem ?>
        <div class="text-center mt-4">
            <a href="/Bazar/index.php">
                <button class="btn btn-primary">Voltar ao Estoque</button>
            </a>
        </div>
    </div>
</body>
