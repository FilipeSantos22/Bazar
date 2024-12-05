<?php
// /Model/itemVenda.php
include_once __DIR__. '/../library/Connection.php'; 
include_once __DIR__. '/Venda.php'; 

class ItemVenda {
    public $id_venda;
    public $id_produto;
    public $quantidade;
    public $preco_unitario;

    public function __construct($id_venda, $id_produto, $quantidade, $preco_unitario) {
        $this->id_venda = $id_venda;
        $this->id_produto = $id_produto;
        $this->quantidade = $quantidade;
        $this->preco_unitario = $preco_unitario;
    }

    public function cadastrar() {
        $db = new DataBase('itens_vendidos');
        $this->id_venda = $db->insert([
            'id_venda' => $this->id_venda,
            'id_produto' => $this->id_produto,
            'quantidade' => $this->quantidade,
            'preco_unitario' => $this->preco_unitario
        ]);
        return true; 
    }

}
?>
