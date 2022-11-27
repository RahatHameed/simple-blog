<?php

namespace  App\Services;

use Exception;
use PDO;
use PDOException;

class DatabaseConnectionService implements DatabaseConnectionServiceInterface
{
    private mixed $connection;

    public function __construct()
    {
        $this->connection = null;
    }

    /**
     * DB connection
     *
     * @return mixed|PDO
     * @throws Exception
     */
    public function getConnection()
    {
        try {
            if (is_null($this->connection)) {
                $this->connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_PERSISTENT => true]);
            }
        } catch (PDOException $e) {
            throw new Exception("Connect failed: " .  $e->getMessage());
        }

        return $this->connection;
    }
}
