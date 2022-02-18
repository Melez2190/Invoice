<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    // public function testApplication()
    // {
    //     $user = User::create([
    //         'name' => 'Test',
    //         'email' => 'testemaile11@test.com',
    //         'password' => 'Password'
    //     ]);
 
    //     $this->actingAs($user)
    //          ->withSession(['foo' => 'bar'])
    //          ->get('/');
    // }
    
}
