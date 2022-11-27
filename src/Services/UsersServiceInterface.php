<?php

namespace App\Services;

interface UsersServiceInterface
{
    /**
     * @return array
     */
    public function getUsers(): array;
}