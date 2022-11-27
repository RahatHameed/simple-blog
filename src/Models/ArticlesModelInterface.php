<?php

namespace App\Models;

interface ArticlesModelInterface
{
    /**
     * @param array $params
     *
     * @return bool
     */
    public function addBlogPost(array $params): bool;
}
