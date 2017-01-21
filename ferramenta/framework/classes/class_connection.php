<?php
//Configuração conexão Mysql via PDO, método conexão protecd
class Connection{
    protected $connection;
    private $host = "localhost";
    private $database = "tcc";
    private $user = "root";
    private $password = "root";

    protected function mt_conection() {

        if (!isset($this->connection)) {
            $this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->database,$this->user,$this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return $this->connection;

    }
}
?>