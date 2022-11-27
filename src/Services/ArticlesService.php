<?php

namespace App\Services;

use App\Models\ArticlesModel;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use App\Services\ArticlesServiceInterface;

class ArticlesService implements ArticlesServiceInterface
{
    public const POST_TITLE      = 'title';
    public const POST_TEXT       = 'text';
    public const POST_IMAGE      = 'image_url';
    public const POST_CREATED_AT = 'created_at';
    public const POST_UPDATED_AT = 'updated_at';
    public const POST_USER_ID    = 'user_id';

    public function __construct(
        private ArticlesModel $articlesModel,
        private int $item_per_page
    ) {
    }

    /**
     * Add post
     *
     * @param array   $params
     * @param Request $request
     *
     * @return bool
     * @throws Exception
     */
    public function addBlogPost(array $params, Request $request): bool
    {
        if (!isset($params[self::POST_TITLE]) || !isset($params[self::POST_TEXT]) || !isset($params[self::POST_IMAGE])) {
            throw new Exception('Please fill all required fields.');
        }

        if (empty($params[self::POST_TITLE]) || empty($params[self::POST_TEXT])) {
            throw new Exception('Parameters cannot be empty!');
        }

        return $this->articlesModel->addBlogPost($params);
    }

    /**
     * @param int $pageNumber
     * @return array
     * @throws Exception
     */
    public function listArticles(int $pageNumber): array
    {
        return $this->articlesModel->articlesList($pageNumber, $this->item_per_page);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getArticleById(int $id): array
    {
        return $this->articlesModel->getArticleById($id);
    }
}
