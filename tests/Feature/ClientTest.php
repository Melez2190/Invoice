<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Concerns\WithTestUser;
use Tests\TestCase;

class ClientTest extends TestCase
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
        $data = [
            'user_id' => $this->user->id,
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
        $this->bootWithTestUser();
   
         $response = $this->json('POST', '/clients', $this->validData());
        
        $response->assertRedirect();

        $this->assertDatabaseHas('clients', [
            'created_by' => $this->user->id,
        ]);

    }

    public function test_update_client()
    {
        $this->bootWithTestUser();
        $client = Client::factory()->create();

        $data = $this->validData();
        
        $response = $this->json('PUT', "/clients/{$client->id}", $data);
        $response->assertRedirect();

        $this->assertDatabaseHas('clients', [
            'updated_by' => $this->user->id,
        ]);
    }

    public function test_delete_client()
    {
        $this->bootWithTestUser();

       
        $client = Client::factory()->create();
    
        $response = $this->json('DELETE', "/clients/{$client->id}");

   
        $response->assertRedirect();
       
        $this->assertSoftDeleted('clients', ['id' => $client->id]);
    }
 
    
}
