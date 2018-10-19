<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DevController
{
    public function providerState(Request $request)
    {
        // pact-provider-verifier posts sth like
        // '{"consumer":"frontend","state":"user with #1 exists","states":["user with #1 exists"]}'
        // to this endpoint!
        $dump = [
            $request->getContent()
        ];

        file_put_contents('/tmp/user-provider-state.log', var_export($dump, true), \FILE_APPEND);

        return new JsonResponse([], Response::HTTP_NO_CONTENT, ['Content-Type' => 'application/json;charset=utf-8']);
    }
}
