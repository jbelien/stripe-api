<?php

declare(strict_types=1);

namespace Tests;

use DI\Container;
use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Request;
use Slim\Psr7\Uri;

class TestCase extends PHPUnit_TestCase
{
    protected function getAppInstance(): App
    {
        $container = new Container();

        $app = AppFactory::createFromContainer($container);

        $app->addRoutingMiddleware();
        $app->addErrorMiddleware(true, true, true);

        return $app;
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function createRequest(string $method, string $path, array $data): ServerRequestInterface
    {
        $uri = new Uri('', '', 80, $path);

        $headers = new Headers();
        $headers->addHeader('Accept', 'application/json');

        $stream = (new StreamFactory())->createStream();

        $request = new Request($method, $uri, $headers, [], [], $stream);
        $request = $request->withParsedBody($data);

        return $request;
    }
}
