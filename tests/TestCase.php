<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

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
}
