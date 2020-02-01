<?php

use Illuminate\Routing\Router;
use Jacob\Horizon\Classes\Controllers\HorizonFileController;

/** @var Router $router */
$router = resolve(Router::class);

$router->group([
    'prefix' => 'vendor/horizon',
], static function() use ($router) {
    $router->get('app.js', [HorizonFileController::class, 'appJs']);

    $router->get('app.css', [HorizonFileController::class, 'appCss']);

    $router->get('app-dark.css', [HorizonFileController::class, 'appDarkCss']);

    $router->get('img/horizon.svg', [HorizonFileController::class, 'horizonSvg']);
});
