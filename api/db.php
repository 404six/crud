<?php

/* constantes de credenciais do banco de dados */
define('MYSQL_HOST', 'localhost'); // ip adress
define('MYSQL_USER', 'root'); // usuario
define('MYSQL_PASSWORD', ''); // senha
define('MYSQL_DB_NAME', 'cadastro'); // nome da database

class db
{
    private $conn;
    public function __construct($init_pdo = true)
    {
        if ($init_pdo) {
            try {
                // tentando iniciar a conexão PDO com o mysql
                $conn = new PDO('mysql: host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
            } catch (PDOException $pdo) {
                die($pdo->getMessage());
            }
            $this->conn = $conn;
        }

        // não se deve iniciar uma sessão caso outra já estiver ativa
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();
    }

    /*
        essa função destroi a conexão PDO e a sessão atual
    */
    public function destroy()
    {
        $this->conn = null;
        session_destroy();
    }

    /*
        essa função verifica se o usuário já tem uma sessão ativa/iniciada
    */
    public function has_session()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    /*
        essa função instancia a class Query para tentar fazer uma requisição ao banco de dados
    */
    public function do_query($query)
    {
        try{
            return new query($this->conn->prepare($query));
        }
        catch(PDOException $e)
        {
            throw new PDOException($e);
        } 
    }

}

class query
{
    private $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function bind_param($array)
    {
        foreach ($array as $param => &$variable) {
            $this->query->bindParam($param, $variable);
        }
        return $this;
    }

    public function execute()
    {
        $this->query->execute();
        return $this;
    }

    public function get_row_count()
    {
        return $this->query->rowCount();
    }

    public function get_result()
    {
        return $this->query->fetch(PDO::FETCH_ASSOC);
    }

    public function get_query()
    {
        return $this->query;
    }
}
