<?php
include __DIR__ . '/head.php';
include __DIR__ . '/assets/css/style.php';

$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="alert text-center alert-success">Ação executada com sucesso!</div>';
            break;
        case 'error':
            $mensagem = '<div class="alert text-center alert-danger">Ação não executada!</div>';
            break;
    }
}

$resultados = '';
foreach ($produtos as $produto) {
    if ($produto->getQuantidade() > 0) {
        $resultados .= '<tr>
                            <td class="text-light">' . $produto->getNome() . '</td>
                            <td class="text-light">' . number_format(floatval(str_replace(',', '.', $produto->getPreco())), 2, '.', '') . '</td>
                            <td class="text-light">' . $produto->getQuantidade() . '</td>
                            <td>
                                <input 
                                    type="checkbox" 
                                    class="produto-checkbox" 
                                    data-id="' . $produto->getId() . '" 
                                    data-preco="' . number_format(floatval(str_replace(',', '.', $produto->getPreco())), 2, '.', '') . '"
                                />
                            </td>
                            <td>
                                <input 
                                    type="number" 
                                    class="form-control produto-quantidade" 
                                    data-id="' . $produto->getId() . '" 
                                    min="1" 
                                    max="' . $produto->getQuantidade() . '" 
                                    value="1" 
                                    disabled
                                />
                            </td>
                        </tr>';
    }
}
?>

<body>
<?= $mensagem ?>

<div class="text-center">
    <h2 class="text-center mt-2">Produtos cadastrados</h2>
    <a href="/Bazar/controllers/cadastrarProduto.php">
        <button class="btn btn-primary mt-3">Novo Produto</button>
    </a>
    <a href="/Bazar/view/confirmarVenda.php">
        <button class="btn btn-info  mt-3">Valor Total Vendido</button>
    </a>
    <a href="/Bazar/view/listarVendas.php">
        <button class="btn btn-danger mt-3">Excluir Venda</button>
    </a>
    <form id="form-venda" action="/Bazar/controllers/cadastrarVenda.php" method="POST">
        <input type="hidden" name="produtos" id="produtos">
        <input type="hidden" name="total" id="total">
        <button type="submit" class="btn btn-success mt-3">Nova Venda</button>
    </form>

    
</div>
<div id="totalVenda" class="mt-3 text-center">
    <h3>Valor total da venda: R$ <span id="valorTotal">0.00</span></h3>
</div>

<section>
    <div class="container-fluid" style="max-height: 600px; max-width: 70%; overflow-y: auto;">
        <table class="table table-striped bg-color">
            <thead>
                <tr class="bg-color">
                    <th scope="col" class="table_color text-light">Nome</th>
                    <th scope="col" class="table_color text-light">Preço</th>
                    <th scope="col" class="table_color text-light">Quantidade</th>
                    <!-- <th scope="col" class="table_color text-light">Categoria</th> -->
                    <th scope="col" class="table_color text-light">Selecionar</th>
                    <th scope="col" class="table_color text-light">Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?= $resultados ?>
            </tbody>
        </table>
    </div>
</section>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.produto-checkbox');
        const inputQuantidades = document.querySelectorAll('.produto-quantidade');
        const valorTotalElement = document.getElementById('valorTotal');

        const calcularTotal = () => {
            let total = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const id = checkbox.getAttribute('data-id');
                    const quantidadeInput = document.querySelector(`.produto-quantidade[data-id="${id}"]`);
                    const quantidade = parseInt(quantidadeInput.value) || 0;
                    const preco = parseFloat(checkbox.getAttribute('data-preco'));

                    total += quantidade * preco;
                }
            });

            valorTotalElement.textContent = total.toFixed(2);
        };

        // Habilitar/desabilitar o campo de quantidade com base no checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const id = this.getAttribute('data-id');
                const quantidadeInput = document.querySelector(`.produto-quantidade[data-id="${id}"]`);
                quantidadeInput.disabled = !this.checked;

                if (!this.checked) {
                    quantidadeInput.value = "1"; // Resetar valor
                }

                calcularTotal();
            });
        });

        // Recalcular total ao alterar a quantidade
        inputQuantidades.forEach(input => {
            input.addEventListener('input', calcularTotal);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const formVenda = document.getElementById('form-venda');
        const checkboxes = document.querySelectorAll('.produto-checkbox');
        const inputProdutos = document.getElementById('produtos');
        const inputTotal = document.getElementById('total');

        formVenda.addEventListener('submit', function (event) {
            const produtosSelecionados = [];
            let totalVenda = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const id = checkbox.getAttribute('data-id');
                    const quantidadeInput = document.querySelector(`.produto-quantidade[data-id="${id}"]`);
                    const quantidade = parseInt(quantidadeInput.value) || 0;
                    const preco = parseFloat(checkbox.getAttribute('data-preco'));

                    produtosSelecionados.push({ id, quantidade, preco });
                    totalVenda += quantidade * preco;
                }
            });

            if (produtosSelecionados.length === 0) {
                alert('Selecione pelo menos um produto para realizar a venda.');
                event.preventDefault();
                return;
            }

            const confirmarVenda = window.confirm('Tem certeza que deseja realizar esta venda?');

            if (!confirmarVenda) {
                event.preventDefault();
                return;
            }

            inputProdutos.value = JSON.stringify(produtosSelecionados);
            inputTotal.value = totalVenda.toFixed(2);
        });
    });
</script>
