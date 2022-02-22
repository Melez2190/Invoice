<?php

namespace Tests\Concerns;

use App\Models\User;


/**
 * This concern can be added to any test class, to add an authenticated user to the test case.
 * This user, and all their relationships, can then be accessed via "$this->user".
 */
trait WithTestUser
{
    /**
     * The user that is authenticated when running the test.
     *
     * @var User
     */
    protected $user;

    /**
     * Boot the trait, creating & authenticating a user.
     *
     * @return void
     */
    protected function bootWithTestUser()
    {
        $this->user = $this->authenticate();
    }

    /**
     * Create a user and authenticate them for the current test case.
     *
     * @return User The authenticated user.
     */
    protected function authenticate()
    {
        
        $user = User::factory()->create();
        
        $this->actingAs($user);

        return $user;
    }
}