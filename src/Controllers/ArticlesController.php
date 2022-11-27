<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends BaseController
{
    public function articlesHome(Request $request): Response
    {

        return $this->renderView(
            getTwig()->render('home.html.twig', [])
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addArticleAction(Request $request): Response
    {
        if (!isUserAuthenticated()) {
            redirect('/login');
        }

        return $this->renderView(getTwig()->render('addArticle.html.twig', []));
    }
}