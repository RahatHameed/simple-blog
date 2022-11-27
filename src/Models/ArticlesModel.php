<?php

namespace App\Models;

use App\Services\DatabaseConnectionService;
use App\Services\ArticlesService;
use Exception;
use PDO;

class ArticlesModel
{
    public function __construct(
        private DatabaseConnectionService $connection
    ) {
    }

    public function addBlogPost(array $params): bool
    {
        $pdo = $this->connection->getConnection();
        try {
            $data = [
                ArticlesService::POST_TITLE      => $params[ArticlesService::POST_TITLE],
                ArticlesService::POST_TEXT       => $params[ArticlesService::POST_TEXT],
                ArticlesService::POST_IMAGE      => $params[ArticlesService::POST_IMAGE],
                ArticlesService::POST_CREATED_AT => date('Y-m-d H:i:s'),
                ArticlesService::POST_UPDATED_AT => date('Y-m-d H:i:s'),
                ArticlesService::POST_USER_ID    => $_SESSION['user']['id'],
            ];
            $sql  =
                "INSERT INTO articles (title, text, image_url, created_at, updated_at, user_id) VALUES (:title, :text, :image_url, :created_at, :updated_at, :user_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
        } catch (Exception $ex) {
            //Log the exception message here
            return false;
        }

        return true;
    }
}
