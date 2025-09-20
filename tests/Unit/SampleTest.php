<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SampleTest extends TestCase
{
    public function testGreetWithName(): void
    {
        $this->assertSame(123, 123);
    }

    #[Test]
    public function hoge(): void
    {
        $this->assertSame(123, 123);
    }
}
