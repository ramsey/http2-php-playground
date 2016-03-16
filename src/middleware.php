<?php
// Application middleware

$app->add(new \Ramsey\App\Middleware\ServerPushMiddleware(
    $app->getContainer()['serverPushAssets']
));
