<?php

class Database
{
    private string $servername = "127.0.0.1";
    private string $username = "root";
    private string $password = "";
    private string $database = "speelhuys";

    public $connection;

    public function start()
    {

        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);


        if ($this->connection->connect_error) {
            die("connectie mislukt " . $this->connection->connect_error);
        }
    }

    public function close()
    {
        $this->connection->close();
    }
}