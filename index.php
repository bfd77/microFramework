<?php

namespace App;

require_once __DIR__ . '/bootstrap.php';

$app = new Application();

$app->get(
    '/',
    function () {
        require __DIR__.'/views/main_page.phtml';
    }
);
$app->run();