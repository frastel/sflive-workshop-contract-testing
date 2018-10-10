<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AggregationController extends AbstractController
{
    public function recipe(RecipeRepository $recipeRepository, UserRepository $userRepository, $id)
    {
        $recipe = $recipeRepository->findById($id);
        $user = $userRepository->findById($id);

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
