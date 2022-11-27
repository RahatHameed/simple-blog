<?php

namespace App\Services;

use App\Models\UserModelInterface;
use Exception;

use function PHPUnit\Framework\isEmpty;

class AuthService implements AuthServiceInterface
{
    public const AUTH_USERNAME = 'username';
    public const AUTH_PASSWORD = 'password';


    public function __construct(
        private UserModelInterface $userModel
    ) {
    }


    /**
     * @param array $params
     * @return bool
     * @throws Exception
     */
    public function getUserByEmailAndPassword(array $params): bool
    {
        if (!isset($params[self::AUTH_USERNAME]) || !isset($params[self::AUTH_PASSWORD])) {
            throw new Exception('Missing parameters');
        }

        if (empty($params[self::AUTH_USERNAME]) || empty($params[self::AUTH_PASSWORD])) {
            throw new Exception('Parameters empty values not allowed!');
        }

        $result = $this->userModel->getUserByEmailAndPassword($params);

        if (!empty($result) && count($result) === 1) {
            $_SESSION['user'] = current($result);
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        unset($_SESSION['user']);

        return true;
    }
}
