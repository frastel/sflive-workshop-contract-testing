<?php

namespace App\Controller;

use App\Gateway\RecipeDetailGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecipeDetailController extends AbstractController
{
    public function detail(RecipeDetailGateway $gateway, $id)
    {
        try {
            $recipe = $gateway->findById($id);
        } catch (\InvalidArgumentException $e) {
            throw new NotFoundHttpException("recipe ${id} not found");
        }

        // replace this example code with whatever you need
        return $this->render(
            'recipe/detail.html.twig',
            [
                'recipe' => $recipe,
            ]
        );
    }
}
