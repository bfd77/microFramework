<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    const HOST = 'http://localhost:3000/';

    public function testServer()
    {
        $result = file_get_contents(self::HOST);
        $this->assertEquals('<h1>Main page</h1>', $result);
    }
}


