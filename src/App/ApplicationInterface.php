<?php

namespace App;

interface ApplicationInterface
{
    public function get(string $path, callable $func);
    public function post(string $path, callable $func);
    public function run();
}
