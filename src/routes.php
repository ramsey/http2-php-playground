<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, 'home.html', [
        'info' => [
            'Server Protocol' => $_SERVER['SERVER_PROTOCOL'],
            'Request Scheme' => $_SERVER['REQUEST_SCHEME'],
            'Server Name' => $_SERVER['SERVER_NAME'],
        ],
    ]);
})->setName('home');

$app->get('/phpinfo', function ($request, $response, $args) {
    ob_start();
    phpinfo();
    $phpinfo = ob_get_contents();
    ob_end_clean();

    return $this->view->render($response, 'phpinfo.html', [
        'phpinfo' => $phpinfo,
    ]);
})->setName('phpinfo');
