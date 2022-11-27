<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends BaseController
{
    /**
     * @param Request $request
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getUsersAction(Request $request): Response
    {
        return $this->renderView(
            getTwig()->render('userProfiles.html.twig', ['usersProfile' => $this->getUsersService()->getUsers()])
        );
    }
}
