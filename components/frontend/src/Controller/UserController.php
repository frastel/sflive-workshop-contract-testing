<?php

namespace App\Controller;

use App\Gateway\UserGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends AbstractController
{
    public function detail(UserGateway $gateway, $id)
    {
        try {
            $user = $gateway->findById($id);
        } catch (\InvalidArgumentException $e) {
            throw new NotFoundHttpException("user ${id} not found");
        }

        // replace this example code with whatever you need
        return $this->render(
            'user/detail.html.twig',
            [
                'user' => $user,
            ]
        );
    }
}
