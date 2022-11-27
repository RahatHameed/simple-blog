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
}
