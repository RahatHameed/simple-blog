<?php

namespace App\Services;

interface AuthServiceInterface
{
    /**
     * @param array $params
     *
     * @return bool
     */
    public function getUserByEmailAndPassword(array $params): bool;


    /**
     * @return bool
     */
    public function logout(): bool;
}
