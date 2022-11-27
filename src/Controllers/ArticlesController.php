<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController
{
    public function articlesHome(Request $request): Response
    {
        return new Response('This will be home page');
    }
}