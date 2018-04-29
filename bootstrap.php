<?php

spl_autoload_register(
    function ($className) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        $fileParts = [__DIR__, 'src', $path];
        $filePath = implode(DIRECTORY_SEPARATOR, $fileParts);
        require_once $filePath;
    }
);
