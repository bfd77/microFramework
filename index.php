<?php

/**
 * @param string $uri
 * @return string
 */
function server($uri) {
    if (preg_match('/^\/test\/?&/', $uri)) {
        return '<h1>TEST</h1>';
    }
}

$uri = $_SERVER['REQUEST_URI'];
echo server($uri);