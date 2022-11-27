<?php

namespace App\Models;

interface UserModelInterface
{
    /**
     * @param array $params
     *
     * @return array
     */
    public function getUserByEmailAndPassword(array $params): array;

    /**
     * @return array
     */
    public function getUsers(): array;
}
