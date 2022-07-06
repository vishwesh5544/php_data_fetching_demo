<?php

class Db
{
    public mysqli $connection;

    private string $serverName = 'localhost';
    private string $dbname;
    private string $serverUser = 'root';
    private string $serverPwd = '';

    public function __construct(string $dbname)
    {
        $this->dbname = $dbname; // Sets the database to be used in current scope (instance)
        try {
            $this->connection = mysqli_connect($this->serverName, $this->serverUser, $this->serverPwd, $this->dbname);
        } catch (\Exception $e) {
            echo "Database error: " . $e->getMessage() . " ";
        }

        if($this->connectionIsEstablished()) {
            return $this->connection;
        }
    }

    private function connectionIsEstablished() : bool {
        return isset($this->connection);
    }
}
