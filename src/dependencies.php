<?php
// DIC configuration

$container = $app->getContainer();

// Twig views
$container['view'] = function ($c) use ($app) {
    $view = new \Slim\Views\Twig('../templates', [
        'charset' => 'utf-8',
        'cache' => false,
        'debug' => true,
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));
    $view->addExtension(new \Twig_Extension_Debug());

    $view['protocolVersion'] = $app->getContainer()['request']->getProtocolVersion();

    return $view;
};