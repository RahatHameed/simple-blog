<?php

namespace App\Models;

use App\Services\AuthService;
use App\Services\DatabaseConnectionServiceInterface;
use Exception;
use PDO;

class UserModel implements UserModelInterface
{
    public function __construct(
        private DatabaseConnectionServiceInterface $connection
    ) {
    }


    /**
     * Get user by user name and password
     *
     * @param array $params
     *
     * @return array
     * @throws Exception
     */
    public function getUserByEmailAndPassword(array $params): array
    {
        $pdo = $this->connection->getConnection();

        try {
            $sql       = 'SELECT * FROM users WHERE username = :username AND password = :password';
            $statement = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $statement->execute(
                [
                    ':username' => $params[AuthService::AUTH_USERNAME],
                    ':password' => getHashedValue($params[AuthService::AUTH_PASSWORD]),
                ]
            );
            $result = $statement->fetchAll();
        } catch (Exception $ex) {
            /**
             * log the error here
             */
            return [];
        }

        return $result;
    }
}
