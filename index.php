<?php

namespace App;

spl_autoload_register(
    function ($className) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className).'.php';
        $fileParts = [__DIR__, 'src', $path];
        $filePath = implode(DIRECTORY_SEPARATOR, $fileParts);
        require_once $filePath;
    }
);

$app = new Application();

$app->get(
    '/',
    function () {
        require __DIR__.'/view/main_page.html';
    }
);
$app->run();