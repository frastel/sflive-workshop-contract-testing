<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecipeController
{
    public function find($id)
    {
        $recipes = $this->getRecipes();

        if (!array_key_exists($id, $recipes)) {
            throw new NotFoundHttpException("recipe #${id} not found");
        }

        return new JsonResponse($recipes[$id], 200, ['Content-Type' => 'application/json;charset=utf-8']);
    }

    /**
     * @return array
     */
    private function getRecipes()
    {
        $recipes = [];
        $recipes[1] = [
            'id' => 1,
            'title' => 'Spiegeleier',
            'subtitle' => '',
            'rating' => 4.5,
            'instructions' => 'Eier in einer Pfanne aufschlagen und braten.',
            'published' => '2017-12-24 20:00:00',
            'authorId' => 1,
            'preparationTime' => 1,
            'difficulty' => 'advanced',
            'image' => 'spiegeleier.jpeg'
        ];

        $recipes[2] = [
            'id' => 2,
            'title' => 'Zuckerberg',
            'subtitle' => 'Ein Haufen Zucker',
            'rating' => 4.5,
            'instructions' => 'Zutaten vermengen, zu einem Berg anhäufen. Fertig! Viel Spaß damit!',
            'published' => '2017-12-24 20:00:00',
            'authorId' => 2,
            'preparationTime' => 1,
            'difficulty' => 'simple',
            'image' => 'zuckerberg.jpeg'
        ];

        $recipes[3] = [
            'id' => 3,
            'title' => 'Pangalaktischer Donnergurgler',
            'subtitle' => 'Der stärkste Drink der Galaxis!',
            'rating' => 4.5,
            'instructions' => 'Die Zutaten, außer der Grenadine, werden zusammen mit drei bis vier Eiswürfeln im Shaker geschüttelt, bis die Eiswürfel sich aufgelöst haben. Danach füllt man den Drink in eine Cocktailschale. Nach dem schälen der Pitahaya schneidet man das Fruchtfleisch in Pyramidenform. Die Pyramide gibt man ins Glas, bevor der Drink hineingeschüttet wird. Die Karambolenscheibe hängt man an den Glasrand. Über das Glas legt man zum Schluss eine Spirale aus der Orangenschale.',
            'published' => '2017-12-24 20:00:00',
            'authorId' => 1,
            'preparationTime' => 10,
            'difficulty' => 'simple',
            'image' => 'donnergurgler.jpeg'
        ];

        for ($i = 1; $i <= 10; $i++) {
            $recipes[10+$i] = [
                'id' => 10+$i,
                'title' => 'lorem recipe #'.$i,
                'subtitle' => substr('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat', 0, rand(10, 120)),
                'rating' => 4.5,
                'instructions' => 'Irgendwas mit den Zutaten machen ...',
                'published' => '2017-12-24 20:00:00',
                'authorId' => 1,
                'preparationTime' => 10,
                'difficulty' => 'expert',
            ];
        }

        return $recipes;
    }
}
