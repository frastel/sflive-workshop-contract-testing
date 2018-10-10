<?php

namespace App\Controller;

use App\Repository\RecipeDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecipeDetailController extends AbstractController
{
    public function detail(RecipeDetailRepository $repository, $id)
    {
        try {
            $recipe = $repository->findById($id);
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
