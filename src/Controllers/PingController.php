<?php

namespace StripeAPI\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PingController
{
    /**
     * @param array<string, mixed> $args
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        /** @var string $json */
        $json = json_encode(['ack' => time()], JSON_THROW_ON_ERROR);

        $response->getBody()->write($json);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
