<?php

namespace App\Services;

use App\Models\UserModelInterface;
use Exception;

use function PHPUnit\Framework\isEmpty;

class UsersService implements UsersServiceInterface
{

    public function __construct(
        private UserModelInterface $userModel
    ) {
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->userModel->getUsers();
    }
}
