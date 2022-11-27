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

    /**
     * @param array $params
     * @return bool
     * @throws Exception
     */
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

    /**
     * @param int $page
     * @param int $items_per_page
     * @return array
     * @throws Exception
     */
    public function articlesList(int $page, int $items_per_page): array
    {
        $offset = ($page - 1) * $items_per_page;
        $pdo    = $this->connection->getConnection();
        try {
            $sql       =
                'SELECT articles.*, users.first_name, users.last_name FROM articles INNER JOIN users ON articles.user_id=users.id order by articles.updated_at DESC LIMIT :offset, :item_per_page ';
            $statement = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
            $statement->bindValue(':item_per_page', $items_per_page, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (Exception $ex) {
            //Log the exception message here
            return [];
        }

        return $result;
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getArticleById(int $id): array
    {
        $pdo = $this->connection->getConnection();
        try {
            $sql       =
                'SELECT articles.*, users.first_name, users.last_name FROM articles INNER JOIN users ON articles.user_id=users.id WHERE articles.id = :id';
            $statement = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $statement->execute(
                [
                    ':id' => $id,
                ]
            );
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (empty($result)) {
                return [];
            }
        } catch (Exception $ex) {
            //Log the exception message here
            return [];
        }

        return current($result);
    }
}
