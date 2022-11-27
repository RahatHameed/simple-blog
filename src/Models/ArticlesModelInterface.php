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

    /**
     * @param int $page
     * @param int $items_per_page
     * @return array
     */
    public function articlesList(int $page, int $items_per_page): array;

    /**
     * @param int $id
     * @return array
     */
    public function getArticleById(int $id): array;
}
