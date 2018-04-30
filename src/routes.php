<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/routes', function(Request $request, Response $response, array $args) {
    $this->logger->info("Viewing routes");
    $routes = $this->routeDaoImpl->getAllRoutes();
    $args['routes'] = $routes;
    return $this->renderer->render($response, 'viewRoutes.phtml', $args);
});

$app->get('/routes/new', function(Request $request, Response $response, array $args) {
    $this->logger->info("Creating new route");
    return $this->renderer->render($response, 'createRoute.phtml', $args);
});

$app->get('/routes/{id}', function(Request $request, Response $response, array $args) {
    $this->logger->info("Viewing route with id " . $args['id']);
    return $this->renderer->render($response, 'route.phtml', $args);
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
