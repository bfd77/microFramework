<?php

namespace App\Tests;

require_once __DIR__ . '/../../../bootstrap.php';

use PHPUnit\Framework\TestCase;
use App;

class ApplicationTest extends TestCase
{
    const HOST = 'http://localhost:3000/';

    public function testServer()
    {
        $renderer = new App\Renderer();
        $expected = $renderer->render('main_page');
        $actual = file_get_contents(self::HOST);
        $this->assertEquals($expected, $actual);
    }
}


