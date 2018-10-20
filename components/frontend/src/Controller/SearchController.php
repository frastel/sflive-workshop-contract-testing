<?php

namespace App\Controller;

use App\Repository\RecipeSearchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    public function index(RecipeSearchRepository $repository, Request $request)
    {
        $needle = $request->query->get('needle', 'chefkoch');

        $recipes = $repository->findLatest(['limit' => 5, 'needle' => $needle]);

        // replace this example code with whatever you need
        return $this->render('home/index.html.twig', [
            'recipes' => $recipes
        ]);
    }
}
