<?php

namespace App\Controller;

use App\Gateway\RecipeSearchGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    public function index(RecipeSearchGateway $gateway, Request $request)
    {
        $needle = $request->query->get('needle', 'chefkoch');

        $recipes = $gateway->findLatest(['limit' => 5, 'needle' => $needle]);

        // replace this example code with whatever you need
        return $this->render('home/index.html.twig', [
            'recipes' => $recipes
        ]);
    }
}
