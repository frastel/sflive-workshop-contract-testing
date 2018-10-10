<?php

namespace App\Controller;

use App\Repository\RecipeSearchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    public function index(RecipeSearchRepository $repository, Request $request)
    {
        $recipes = $repository->findLatest(['limit' => 5]);

        // replace this example code with whatever you need
        return $this->render('home/index.html.twig', [
            'recipes' => $recipes
        ]);
    }
}
