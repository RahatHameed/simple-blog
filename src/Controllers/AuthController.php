<?php

namespace App\Controllers;

use App\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends BaseController
{
    public function loginAction(): Response
    {
        return $this->renderView(
            getTwig()->render('login.html.twig', [])
        );
    }

    public function userLoginAction(Request $request): JsonResponse
    {
        $response    = new JsonResponse();

        $params = [
            AuthService::AUTH_USERNAME => $request->get(AuthService::AUTH_USERNAME, ''),
            AuthService::AUTH_PASSWORD => $request->get(AuthService::AUTH_PASSWORD, ''),
        ];

        try {
            $result = $this->getAuthService()->getUserByEmailAndPassword($params);
            if ($result === true) {
                $response->setStatusCode(Response::HTTP_OK);
                $response->setData("User has been loged in successfully.");
            } else {
                $response->setStatusCode(Response::HTTP_NOT_FOUND);
                $response->setData("Invalid credentials please try again");
            }
        } catch (Exception $ex) {
            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $response->setData($ex->getMessage());
        }

        return $response;
    }

    /**
     *
     * @param Request $request
     */
    public function logoutAction(Request $request): void
    {
        if ($this->getAuthService()->logout()) {
            redirect('/');
        }
    }
}