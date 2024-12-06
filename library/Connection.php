<?php

class DataBase {

    const HOST = 'bazarirc.com';
    const NAME = 'u665846806_bazar';
    const USER = 'u665846806_filipeDBA';
    const PASSWORD = 'Vodivin@2001';
    const PORT = '3306';     

    private $table;
    private $connection;

    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsável por criar uma conexão com banco de dados.
     */
    public function setConnection() {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::NAME,
                self::USER,
                self::PASSWORD
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sempre que tiver algum erro, o PDO trava o sistema e retorna uma EXCEPTION.

        } catch (\PDOException $e) {
            die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
        }
    }

    public function execute($query, $params = []) {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (\PDOException $e) {
            die('Erro na execução da query: ' . $e->getMessage());
        }
    }

    public function insert($values) {
        $fields = array_keys($values); 
        $binds = array_pad([], count($fields), '?');
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        $this->execute($query, array_values($values));
        return $this->connection->lastInsertId();
    }

    public function update($where, $values) {
        $fields = array_keys($values);
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;
        $this->execute($query, array_values($values));
        return true;
    }

    public function delete($where) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        $this->execute($query);
        return true;
    }

    public function select($where = null, $order = null, $limit = null, $fields = '*') {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : 'ORDER BY id ASC'; // Corrige o padrão para um ORDER BY válido
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;
        return $this->execute($query);
    }

    public function selectLastInserted($fields = 'id') {
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ORDER BY id DESC LIMIT 1';
        return $this->execute($query);
    }    

    public function selectEndereco($where = null, $order = null, $limit = null, $fields = '*') {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : 'IDENDERECO';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;
        return $this->execute($query);
    }

    // Testa conexão
    public function testConnection() {
        try {
            $this->connection->query('SELECT 1');
            echo 'Conexão com o banco de dados estabelecida com sucesso!';
        } catch (\PDOException $e) {
            die('Erro ao testar a conexão: ' . $e->getMessage());
        }
    }
}
?>