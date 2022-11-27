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
}