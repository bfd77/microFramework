<?php

namespace App;

require_once __DIR__ . '/bootstrap.php';

$app = new Application();
$renderer = new Renderer();

$app->get(
    '/',
    function () use ($renderer) {
        return $renderer->render('main_page');
    }
);
$app->run();