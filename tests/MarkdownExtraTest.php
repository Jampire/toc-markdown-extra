<?php

namespace Jampire\Markdown\Toc\Test;

use Jampire\Markdown\Toc\MarkdownExtra;
use PHPUnit\Framework\TestCase;

class MarkdownExtraTest extends TestCase
{
    public function testToc()
    {
        $source = file_get_contents(__DIR__ . '/fixtures/input.md');
        $expected = file_get_contents(__DIR__ . '/fixtures/output.html');
        $this->assertEquals($expected, MarkdownExtra::defaultTransform($source));
    }

    public function testInstance()
    {
        $md = new MarkdownExtra();
        $this->assertInstanceOf('\\Michelf\\MarkdownExtra', $md);
    }
}
