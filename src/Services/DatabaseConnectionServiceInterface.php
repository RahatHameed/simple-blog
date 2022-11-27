<?php

namespace App\Services;

interface DatabaseConnectionServiceInterface
{
    /**
     * @return mixed
     */
    public function getConnection();
}
