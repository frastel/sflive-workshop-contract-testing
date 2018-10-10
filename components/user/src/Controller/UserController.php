<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController
{
    public function find($id)
    {
        $users = $this->getUsers();

        if (!array_key_exists($id, $users)) {
            throw new NotFoundHttpException("user #${id} not found");
        }

        return new JsonResponse($users[$id], 200, ['Content-Type' => 'application/json;charset=utf-8']);
    }

    private function getUsers()
    {
        $users = [];

        $users[1] = [
            'id' => 1,
            'name' => 'Chefkoch',
            'registered' => 1199178610, // 2008-01-01 10:10:10
            //'registeredAt' => '2008-01-01 10:10:10',
            'about' => 'Chefkoch.de - Biggest cooking platform in Europe'
        ];

        $users[2] = [
            'id' => 2,
            'name' => 'Internetz',
            'registered' => 1230861845, // 2009-01-02 03:04:05
            //'registeredAt' => '2009-01-02 03:04:05',
            'about' => 'Can u haz Internetz?'
        ];

        $users[3] = [
            'id' => 3,
            'name' => 'John',
            'registered' => 1510395060, // 2017-11-11 11:11:00
            //'registeredAt' => '2017-11-11 11:11:00', // 2017-11-11 11:11:00,
            'about' => null
        ];

        return $users;
    }
}
