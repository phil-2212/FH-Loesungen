<?php


class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "backenduebung";

    private $dbHandler;
    private $error;

    public function __construct() {
    }

    public function connect()
    {
       $this->dbHandler = null;

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8';
        $options = array (
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbHandler = new PDO ($dsn, $this->user, $this->pass, $options);
        }
        catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
        return $this->dbHandler;
    }
}