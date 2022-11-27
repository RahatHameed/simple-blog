<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

interface ArticlesServiceInterface
{
    /**
     * @param array $params
     * @param Request $request
     * @return bool
     */
    public function addBlogPost(array $params, Request $request): bool;
}