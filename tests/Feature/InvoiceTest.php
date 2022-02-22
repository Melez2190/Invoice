<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Concerns\WithTestUser;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase, WithTestUser;


    public function setUp() :void
    {
        parent::setUp();
    }
    
    protected function validData()
    {
        $client = Client::factory()->create();
        $data = [
            'client_id' => $client->id,
            'date_of_issue' => '2022-03-09',
            'valuta'  => '2022-04-15',
            'status' => 0,
        ];
        return $data;
        
    }
    public function test_create_invoice()
    {
        $this->bootWithTestUser();

        $response = $this->json('POST', '/invoices', $this->validData());
        $response->assertRedirect();
        $this->assertDatabaseHas('invoices', [
            'created_by' => $this->user->id,
            
        ]);
    }

    // public function test_update_invoice()
    // {
    //     $this->bootWithTestUser();
    //     $client = Client::factory()->create();

    //     $invoice = Invoice::factory()->create([
    //         'client_id' => $client->id,
    //         'date_of_issue' => '2022-03-01',
    //         'valuta'  => '2022-04-22',
    //         'status' => 0,
    //     ]);
    //     $response = $this->json('PUT', "/invoices/{$invoice->id}", $this->validData());
    //     $response->assertRedirect();

    //     $this->assertDatabaseHas('invoices', [
    //         'updated_by' => $this->user->id,
    //     ]);
    // }
}
