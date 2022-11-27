<?php

namespace App\Controllers;

use App\Services\ArticlesService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends BaseController
{
    public const PAGE_NUMBER = 'page';

    /**
     * @param Request $request
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function articlesHome(Request $request): Response
    {

        $pageNumber = $request->get(self::PAGE_NUMBER, 1);
        return $this->renderView(
            getTwig()->render('home.html.twig', ['articlesList' => $this->getArticlesService()->listArticles($pageNumber), 'page' => $pageNumber])
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

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function addUserArticleAction(Request $request): JsonResponse
    {
        $response = new JsonResponse();
        if (!isUserAuthenticated()) {
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
            $response->setData('Not allowed');

            return $response;
        }

        $params = [
            ArticlesService::POST_TITLE => $request->get(ArticlesService::POST_TITLE, ''),
            ArticlesService::POST_TEXT  => $request->get(ArticlesService::POST_TEXT, ''),
            ArticlesService::POST_IMAGE  => $request->get(ArticlesService::POST_IMAGE, ''),
        ];

        try {
            $result = $this->getArticlesService()->addBlogPost($params, $request);
            if ($result === true) {
                $response->setStatusCode(Response::HTTP_CREATED);
                $response->setData('Article has been added');
            } else {
                $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
                $response->setData('Unable to add article.');
            }
        } catch (Exception $ex) {
            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData($ex->getMessage());
        }

        return $response;
    }

    /**
     * @param $id
     * @param Request $request
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function articleDetail($id, Request $request): Response
    {
        return $this->renderView(
            getTwig()->render('articleDetail.html.twig', ['post' => $this->getArticlesService()->getArticleById($id)])
        );
    }
}