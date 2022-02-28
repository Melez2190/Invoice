<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use PHPUnit\Framework\MockObject\MockBuilder;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    /**
     * Prepare environment for testing
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }


    /**
     * Returns a builder object to create mock objects using a fluent interface.
     *
     * @psalm-template RealInstanceType of object
     * @psalm-param class-string<RealInstanceType> $className
     * @psalm-return MockBuilder<RealInstanceType>
     */
    public function getMockBuilder(string $className): MockBuilder
    {
        $this->recordDoubledType($className);

        return new MockBuilder($this, $className);
    }
}
