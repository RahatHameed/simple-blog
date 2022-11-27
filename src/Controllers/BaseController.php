<?php

namespace App\Controllers;

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
     * @param string $view
     *
     * @return Response
     */
    protected function renderView(string $view): Response
    {
        return new Response($view);
    }
}
