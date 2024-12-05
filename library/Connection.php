<?php

class DataBase {

    const HOST =     'localhost';
    const NAME =     'bazar';
    const USER =     'postgres';
    const PASSWORD = '1234';
    const PORT =     '5432';

    private $table;
    private $connection;

    public function __construct ($table = null) {
        $this->table = $table;
        $this->setConnection();
    }
    /**
     * Método responsável por criar uma conexão com banco de dados.
     */
    public function setConnection () {
        try {

            $this->connection = new PDO ('pgsql:host='.self::HOST.';port='.self::PORT.';dbname='.self::NAME, self::USER, self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sempre que tiver algum erro, o PDO trava o sistema e retorna uma EXCEPTION.

        } catch (\PDOException $e) {
            die('Erro'.$e->getMessage());
        }
    }

    public function execute ($query, $params = []) {

        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;

        } catch (\PDOException $e) {
            die('Erro'.$e->getMessage());
        }
    }

    public function insert ($values) {
        
        $fields = array_keys($values); 
        $binds = array_pad([],count($fields), '?');
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();
    }


    public function update ($where, $values) {
        
        $fields = array_keys($values);
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,', $fields). '=? WHERE '.$where;
       
        $this->execute($query, array_values($values));
        return true;
    }

    public function delete ($where) {
        
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
        $this->execute($query);

        return true;
    }

    public function select ($where = null, $order = null, $limit = null, $fields = '*') {

        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : 'ID';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' ORDER BY ID '.$limit;
        return $this->execute($query);
    }

    public function selectLastInserted($fields = 'id') {
        // Prepara a consulta para pegar o último id inserido
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ORDER BY id DESC LIMIT 1';
        
        // Executa a query e retorna o resultado
        return $this->execute($query);
    }
    

    public function selectEndereco ($where = null, $order = null, $limit = null, $fields = '*') {

        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : 'IDENDERECO';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' ORDER BY IDENDERECO '.$limit;
        return $this->execute($query);
    }

    //testa conexão
    public function testConnection() {
        try {
            $this->connection->query('SELECT 1');
            echo 'Conexão com o banco de dados estabelecida com sucesso!';
        } catch (\PDOException $e) {
            die('Erro ao testar a conexão: '.$e->getMessage());
        }
    }
}
?>