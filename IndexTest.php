<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../index.php';

class IndexTest extends TestCase
{
    public function testOutput()
    {
        $this->expectOutputString('Hello World dari index.php!');
        include __DIR__ . '/../index.php';
    }
}
