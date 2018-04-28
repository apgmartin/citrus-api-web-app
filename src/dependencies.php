<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// db
$container['db'] = function ($c) {
    $db = $c['settings']['db'];

    $pdo = new PDO(
        'mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'],
        $db['password']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};


// attribute DAO
$container['attributeDaoImpl'] = function($c) {
    $attributeDao = new Db\Attribute\AttributeDaoImpl($c->db);

    return $attributeDao;
};

// route DAO
$container['routeDaoImpl'] = function($c) {
    return new Db\Route\RouteDaoImpl($c->db, $c->routeDataDaoImpl);
};

// route-data DAO
$container['routeDataDaoImpl'] = function($c) {
    return new \Db\RouteData\RouteDataDaoImpl($c->db, $c->logger);
};
