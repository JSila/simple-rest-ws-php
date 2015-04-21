<?php

require 'vendor/autoload.php';

use App\User;
use App\Router;

$app = new Router;

$app->get('/users/:userId', function($userId) {
    $user = new User;

    $user = $user->with('country')->find($userId);

    return $user->toJson();
});

$app->run();
