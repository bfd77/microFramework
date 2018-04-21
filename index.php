<?php

/**
 * @param string $uri
 * @return string
 */
function server($uri) {
    if ($uri === '/') {
        return '<h1>Main page</h1>';
    }
    if (preg_match('/^\/test\/?$/', $uri)) {
        return '<h1>TEST</h1>';
    }
    return 'Not found';
}

$uri = $_SERVER['REQUEST_URI'];
echo server($uri);