<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Middleware\BodyParsingMiddleware;
use Slim\Routing\RouteCollectorProxy;
use StripeAPI\Configuration;
use StripeAPI\Controllers\CheckoutSessionController;

require __DIR__.'/../vendor/autoload.php';

$debug = (new Configuration())->debug;

$container = new Container();

$app = AppFactory::createFromContainer($container);

$app->addRoutingMiddleware();
$app->addErrorMiddleware($debug, true, true);

$app->group('', function (RouteCollectorProxy $group) {
    $group->post('/checkout/session/{mode:(?:payment|subscription)}', CheckoutSessionController::class);
})->addMiddleware(new BodyParsingMiddleware());

$app->run();
