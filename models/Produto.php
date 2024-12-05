<?php
// Model/produto.php
include_once __DIR__. '/../library/Connection.php';
// include_once __DIR__. '/Endereco.php';

class Produto {
    public $id;
    public $nome;
    public $preco;
    public $quantidade;
    public $categoria;

    // public function __construct($nome, $preco, $quantidade, $categoria = null) {
    //     $this->nome = $nome;
    //     $this->preco = $preco;
    //     $this->quantidade = $quantidade;
    //     $this->categoria = $categoria;
    // }

    // Função para inserir produto no banco
    public function cadastrar() {
        $db = new DataBase('produtos');
        $this->id = $db->insert([
            'nome' => $this->nome,
            'preco' => $this->preco,
            'quantidade' => $this->quantidade,
            'categoria' => $this->categoria
        ]);
        return true;
    }


    // Função para atualizar o estoque do produto
    public function atualizarEstoque($id_produto) {
        $db = new DataBase('produtos');
        $produto = $this->getProduto($id_produto);
        return $db->update("id = $id_produto", ['quantidade' => $produto->quantidade - 1]);
    }

    public static function getProdutos($where = null, $order = null, $limit = 100) {
            return (new DataBase('produtos'))->select($where, $order, $limit)
                                            ->fetchAll(PDO::FETCH_CLASS, self::class);
        }


    public static function getProduto($id) {
            return (new DataBase('produtos'))->select('id = '.$id)
                                            ->fetchObject((self::class));
    }

    public function getId(){
            return $this->id;
    }

    public function setId($id)
    {
            $this->id = $id;
            return $this;
    }

    public function getNome()
    {
            return $this->nome;
    }

    public function setNome($nome)
    {
            $this->nome = $nome;
            return $this;
    }

    public function getPreco()
    {
            return $this->preco;
    }

    public function setPreco($preco)
    {
            $this->preco = $preco;
            return $this;
    }

    public function getQuantidade()
    {
            return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
            $this->quantidade = $quantidade;
            return $this;
    }

    public function getCategoria()
    {
            return $this->categoria;
    }

    
    public function setCategoria($categoria)
    {
            $this->categoria = $categoria;
            return $this;
    }

}
?>
