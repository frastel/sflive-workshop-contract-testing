<?php

namespace App\Controller;

use App\Gateway\RecipeSearchGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    public function index(RecipeSearchGateway $gateway, Request $request)
    {
        $recipes = $gateway->findLatest(['limit' => 5]);

        // replace this example code with whatever you need
        return $this->render('home/index.html.twig', [
            'recipes' => $recipes
        ]);
    }
}
