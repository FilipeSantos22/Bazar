<?php
// /Model/venda.php
include_once __DIR__. '/Produto.php';

class Venda {
    public $total_arrecadado;
    public $id;
    public $data_venda;

    // public function __construct($total_arrecadado) {
    //     $this->total_arrecadado = $total_arrecadado;
    // }

    // id SERIAL PRIMARY KEY,
    // data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    // total_arrecadado DECIMAL(10, 2) NOT NUL

    function cadastrar () {

        $obDatabaseEndereco = new DataBase('vendas');
        $this->id = $obDatabaseEndereco->insert([
                                'total_arrecadado'  => $this->total_arrecadado,
                         ]);     
        return true;         
    }

    /**
     * Método para registrar os itens vendidos associados a esta venda.
     */
    public function setItensVendidosss($id_produto) {
        $obDatabaseEndereco = new DataBase('itens_vendidos');
        $ObjProduto = new Produto();
        $produto = $ObjProduto->getProduto($id_produto);
        $ObjVenda = new Venda();
        $venda = $ObjVenda->getVenda();
        $this->id = $obDatabaseEndereco->insert([
            'id_venda'  => $venda->id,
            'id_produto'  => $id_produto,
            'quantidade'  => 1,
            'preco_unitario'  => $produto->preco,
     ]);     
    }

    /**
     * Método para registrar os itens vendidos associados a esta venda.
     */
    public function setItensVendidos($id_produto, $quantidade, $preco_unitario) {
        $obDatabaseEndereco = new DataBase('itens_vendidos');
        $ObjProduto = new Produto();
        $produto = $ObjProduto->getProduto($id_produto); // Obtendo os detalhes do produto
        $ObjVenda = new Venda();
        $venda = $ObjVenda->getVenda(); // Obtendo a venda atual
        $this->id = $obDatabaseEndereco->insert([
            'id_venda'       => $venda->id,
            'id_produto'     => $id_produto,
            'quantidade'     => $quantidade,
            'preco_unitario' => $preco_unitario,
        ]);     
    }

    /**
     * Método para calcular o total acumulado de todas as vendas.
     */
    public static function getTotalVendas() {
        $obDatabase = new DataBase('vendas');
        
        $query = 'SELECT total_arrecadado FROM vendas where is_deleted = FALSE';
        
        // Executando a consulta
        $result = $obDatabase->execute($query)->fetchAll(PDO::FETCH_ASSOC);
        
        // Variável para armazenar o total das vendas
        $totalVendas = 0;
        
        // Itera sobre os resultados e converte cada 'total_arrecadado' de VARCHAR para número
        foreach ($result as $row) {
            // Converter o valor de 'total_arrecadado' para float e somar
            $totalVendas += (float) str_replace(',', '.', $row['total_arrecadado']);
        }
        
        // Retorna o valor total das vendas
        return number_format($totalVendas, 2, '.', '');
    }
    

    public static function getVendas($where = null, $order = null, $limit = 100) {
        return (new DataBase('vendas'))->select($where, $order, $limit)
                                        ->fetchAll(PDO::FETCH_CLASS, self::class);
    }


    public static function getVenda() {
        return (new DataBase('vendas'))->selectLastInserted()
                                        ->fetchObject((self::class));
    }

     /**
     * Método para definir o valor total arrecadado da venda.
     */
    public function setTotalArrecadado($total) {
        if (!is_numeric($total)) {
            throw new Exception("O valor total arrecadado deve ser um número.");
        }
        $this->total_arrecadado = number_format((float)$total, 2, '.', '');
        return $this;
    }

    public function excluirVenda() {
        $obDatabase = new DataBase('vendas');
        // Atualiza o campo is_deleted para TRUE
        return $obDatabase->update('id = ' . $this->id, ['is_deleted' => 1]);
    }
    

     /**
     * Método para obter o valor total arrecadado da venda.
     */
    public function getTotalArrecadado() {
        return $this->total_arrecadado;
    }

    public function getPreco()
    {
            return $this->total_arrecadado;
    }

    public function setPreco($total_arrecadado)
    {
            $this->total_arrecadado = $total_arrecadado;
            return $this;
    }

}
?>
