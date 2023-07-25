<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Middleware\BodyParsingMiddleware;
use Slim\Routing\RouteCollectorProxy;
use StripeAPI\Configuration;
use StripeAPI\Controllers\CheckoutSessionController;
use StripeAPI\Controllers\PingController;
use StripeAPI\Middlewares\CORSMiddleware;

require __DIR__.'/../vendor/autoload.php';

$debug = (new Configuration())->debug;

$container = new Container();

$app = AppFactory::createFromContainer($container);

$app->add(CORSMiddleware::class);
$app->addRoutingMiddleware();
$app->addErrorMiddleware($debug, true, true);

$app->redirect('/', 'https://github.com/jbelien/stripe-api', 301);

$app->map(['OPTIONS', 'GET'], '/ping', PingController::class);

$app->group('', function (RouteCollectorProxy $group) {
    $group->map(['OPTIONS', 'POST'], '/checkout/session/{mode:(?:payment|subscription)}', CheckoutSessionController::class);
})->addMiddleware(new BodyParsingMiddleware());

$app->run();
