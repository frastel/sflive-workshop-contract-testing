<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends AbstractController
{
    public function detail(UserRepository $repository, $id)
    {
        try {
            $user = $repository->findById($id);
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
