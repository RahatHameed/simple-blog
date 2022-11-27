<?php

namespace App\Controllers;

use App\Services\ArticlesService;
use App\Services\UsersService;
use App\Services\AuthService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BaseController
 *
 * @package App\Controllers
 */
class BaseController
{

    /**
     * @return AuthService
     * @throws Exception
     */
    protected function getAuthService(): AuthService
    {
        /** @var AuthService $authService */
        $authService = getContainer()->get('auth.service');
        return $authService;
    }

    /**
     * @return ArticlesService
     * @throws Exception
     */
    protected function getArticlesService(): ArticlesService
    {
        /** @var ArticlesService $articlesService */
        $articlesService = getContainer()->get('articles.service');

        return $articlesService;
    }

    /**
     * @param string $view
     *
     * @return Response
     */
    protected function renderView(string $view): Response
    {
        return new Response($view);
    }

    /**
     * @return UsersService
     * @throws Exception
     */
    protected function getUsersService(): UsersService
    {
        /** @var UsersService $usersService */
        $usersService = getContainer()->get('users.service');
        return $usersService;
    }
}
