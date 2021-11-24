<?php
require("__config.php");

class DatabaseException extends Exception
{
    public function errorMessage() 
    {
        // Error message
        $errorMsg = 'Erro em '.$this->getFile().': <b>'.$this->getMessage().'</b>';
        return $errorMsg;
    }
}

class Database
{
    // Connection
    private $conn;

    // Variables to connect to database
    private const USING_CLOUD = AZURE_CLOUD_MARIADB;
    private const HOSTNAME = DB_SERVER;
    private const USERNAME = DB_USERNAME;
    private const PASSWORD = DB_PASSWORD;
    private const DATABASE = DB_DATABASE;
    private $options;

    public function __construct()
    {
        $this->connect();
    }
  
    private function connect()
    {
        try
        {
            $url = "mysql:host=" . self::HOSTNAME . ";dbname=" . self::DATABASE;

            if(self::USING_CLOUD)
            {
                $this->options = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::MYSQL_ATTR_SSL_CA => DB_SSL_FILEPATH,
                    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                );
            }

            $this->conn = new PDO($url, self::USERNAME, self::PASSWORD, $this->options);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            throw new DatabaseException("Ocorreu um erro para conectar ao SGBD: " . $e->getMessage());
        }
    }

    public function executeCommand($command)
    {
        try
        {
            $this->conn->exec($command);
            $this->close(); // Close connection
        }
        catch(PDOException $e)
        {
            throw new DatabaseException("Ocorreu um erro no comando: " . $e->getMessage());
        }
    }

    public function getRowFromQuery($command)
    {
        $stmt = $this->conn->query($command); // Returns an object from class PDOStatement
        $this->conn->exec($command);

        if($this->validateQuery($stmt) === false)
        {
            throw new DatabaseException();
        }

        // Close the connection
        $this->close();

        return $this->retrieveNextRow($stmt);
    }

    public function getAllRowsFromQuery($command)
    {
        try
        {
            $stmt = $this->conn->query($command); // Returns an object from class PDOStatement
            $this->conn->exec($command);
        }
        catch(PDOException $e)
        {
            throw new DatabaseException("Ocorreu um erro para pegar as linhas: " . $e->getMessage());
        }

        // Close the connection
        $this->close();

        // Return query result
        return $this->retrieveAllRows($stmt);
    }

    private function validateQuery($statement)
    {
        return $statement->rowCount() === 1;
    }

    private function retrieveNextRow($statement)
    {
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    private function retrieveAllRows($statement)
    {
        return $statement->fetchAll();
    }

    // Close the connection
    private function close()
    {
        $this->conn = null;
    }
}

class DBCommands
{
    public static function GET_USER_LOGIN($username, $password)
    {
        return SQL_CMD_SELECT_ID_NAME_FROM_USER . " WHERE username = '$username' and password = '$password'";
    }
    public static function INSERT_INTO_USER($cpf, $nomecompleto, $dtnascimento, $telefone, $email, $username, $password)
    {
        return SQL_CMD_INSERT_INTO_USER .
            "('" . $cpf . "','" .
                $nomecompleto . "','" .
                $dtnascimento . "','" .
                $telefone . "','" .
                $email . "','" .
                $username . "','" .
                $password . "')";
    }

    public static function GET_ALL_GAMEMATCH($codusuario)
    {
        return SQL_CMD_SELECT_ALL_FROM_GAMEMATCH . " WHERE codusuario = " . $codusuario;
    }
    public static function INSERT_INTO_GAMEMATCH($codusuario, $tablinhas, $tabcolunas, $numbombas, $modo, $tempojogado, $status, $dtpartida)
    {
        return SQL_CMD_INSERT_INTO_GAMEMATCH .
            "('" . $codusuario . "','" .
                $tablinhas . "','" .
                $tabcolunas . "','" .
                $numbombas . "','" .
                $modo . "','" .
                $tempojogado . "','" .
                $status . "','" .
                $dtpartida . "')";
    }                                   
}
?> 