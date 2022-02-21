<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Concerns\WithTestUser;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithTestUser;
   
/**
     * Setup test environment for this test
     */
    public function setUp() :void
    {
        parent::setUp();
    }
    protected function validData()
    {
        $user = User::factory()->create();

        $data = [
            'user_id' => $user->id,
            'name' => 'test name',
            'city' => 'test name',
            'address' => 'test name',
            'account_number' => '1233242',
            'id_number' => '1233242',
            'tax_number' => '1233242',
            'zip_code' => '1233242',
            'email' => 'test132@testemail.com',
            'phone_number' => '06433242'
        ];
        return $data;
    }
    public function test_create_client()
    {
        // $user = User::factory()->create();
       
        //  Client::create($this->validData());
       dd($this->user);
        $response = $this->json('POST', '/clients/store', $this->validData());
        // $this->json('POST', '/cities', $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('clients', [
            'name' => 'test name'
        ]);

    }

    
}
