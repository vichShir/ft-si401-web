<?php
class Database
{
    // Connection
    private $conn;

    // Variables to connect to database
    private $hostname = "progweb.mariadb.database.azure.com";
    private $username = "vichshir@progweb";
    private $password = "x9GCjKmGkV4EMLs";
    private $db = "campominado";
    private $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::MYSQL_ATTR_SSL_CA => 'misc/BaltimoreCyberTrustRoot.crt.pem',
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    );

    public function __construct()
    {
        $this->connect();
    }
  
    private function connect()
    {
        try
        {
            $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->db", $this->username, $this->password, $this->options);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Ocorreu um erro: " . $e->getMessage();
        }
    }

    public function executeCommand($sqlCommand)
    {
        try
        {
            $this->conn->exec($sqlCommand);
        }
        catch(PDOException $e)
        {
            echo "Ocorreu um erro: " . $e->getMessage();
        }
        
        $this->close(); // Close the connection
    }

    public function executeQuery($sqlCommand)
    {
        try
        {
            $stmt = $this->conn->query($sqlCommand); // Returns an object from class PDOStatement
            $this->conn->exec($sqlCommand);

            // Identify entity
            $entity = $this->identifyEntity($sqlCommand);
            if($entity == "jogador")
                $queryResult = $this->getQueryResultFromJogador($stmt);
            else
                echo "Entidade não identificada!";
        }
        catch(PDOException $e)
        {
            echo "Ocorreu um erro: " . $e->getMessage();
        }

        // Close the connection
        $this->close();

        // Return query result
        return $queryResult;
    }

    private function identifyEntity($sqlCommand)
    {
        $entity = end(explode("FROM", $sqlCommand));
        return trim($entity);
    }

    private function getQueryResultFromJogador($stmt)
    {
        $queryResult = array();
        $index = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $queryResult[$index] = array();
            $queryResult[$index]['cpf'] = $row['cpf'];
            $queryResult[$index]['nome'] = $row['nome'];
            $queryResult[$index]['dtnascimento'] = $row['dtnascimento'];
            $queryResult[$index]['telefone'] = $row['telefone'];
            $queryResult[$index]['email'] = $row['email'];
            $queryResult[$index]['username'] = $row['username'];
            $queryResult[$index]['password'] = $row['password'];
            $index++;
        }

        return $queryResult;
    }

    // Close connection
    private function close()
    {
        $this->conn = null;
    }
}

class DBCommands
{
    public static $getJogadorCMD = "SELECT * FROM jogador";
    public static function insertJogadorCMD($cpf, $nome, $dtnascimento, $telefone, $email, $username, $password)
    {
        return "INSERT INTO jogador VALUES ('" . $cpf . "','" . 
                                                $nome . "', '" . 
                                                $dtnascimento . "', '" .
                                                $telefone . "', '" . 
                                                $email . "', '" .
                                                $username . "', '" .
                                                $password . "')";
    }                                                        
}
?> 