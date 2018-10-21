<?php

namespace App\Controller;

use App\Gateway\RecipeGateway;
use App\Gateway\UserGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AggregationController extends AbstractController
{
    public function recipe(RecipeGateway $recipeGateway, UserGateway $userGateway, $id)
    {
        $recipe = $recipeGateway->findById($id);
        $user = $userGateway->findById($id);

        if (!$recipe) {
            throw new NotFoundHttpException("recipe ${id} not found");
        }

        // replace this example code with whatever you need
        return new JsonResponse(
            [
                'recipe' => $recipe->serialize(),
                'author' => $user->serialize(),
            ],
            200,
            ['Content-Type' => 'application/json;charset=utf-8']
        );
    }
}
