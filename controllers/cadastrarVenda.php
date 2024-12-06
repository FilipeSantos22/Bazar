<?php
require_once __DIR__ . '/../models/Venda.php';
require_once __DIR__ . '/../models/Produto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['produtos'], $_POST['total'])) {
        $produtos = json_decode($_POST['produtos'], true);
        $total = $_POST['total'];

        // Cria uma nova venda
        $venda = new Venda();
        $venda->setTotalArrecadado($total);
        $venda->cadastrar();

        // Verifica se a decodificação foi bem-sucedida
        if ($produtos) {
            // Agora é possível iterar sobre o array
            foreach ($produtos as $produto) {
                $venda->setItensVendidos($produto['id'], /**/ 1, $produto['preco']);
            }
        } else {
            echo "Erro ao decodificar os produtos.";
            exit;
        }


        // Redireciona para a confirmação da venda
        header('Location: https://bazarirc.com/view/confirmarVenda.php?venda=success');
        exit;
    } else {
        header('Location: https://bazarirc.com/view/confirmarVenda.php?venda=error');
        exit;
    }
}
