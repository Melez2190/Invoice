<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Concerns\WithTestUser;
use Tests\TestCase;

class ItemTest extends TestCase 
{
    use RefreshDatabase, WithTestUser;
   
    protected function validData()
    {
        $client = Client::factory()->create();
        $invoice = Invoice::factory()->create([ 
        'client_id' => $client->id,
        'date_of_issue' => '2022-03-01',
        'valuta'  => '2022-04-22',
        'status' => 0,]);

        $data = [
            'invoice_id' => $invoice->id,
            'description' => 'opis test',
            'price'=> '100',
            'quantity' => '1000',
            'pdv' => 18,
        ];
        return $data;
    }

    public function test_create_item()
    {
        $this->bootWithTestUser();

        $response = $this->json('POST', '/items', $this->validData());
        $response->assertRedirect();
        $this->assertDatabaseHas('items', [
            'created_by' => $this->user->id,
        ]);
    }

    public function test_update_item()
    {
        $this->bootWithTestUser();
      
        $item = Item::factory()->create($this->validData());
        
        $response = $this->json('PUT', "/items/{$item->id}", $this->validData());
        $response->assertRedirect();

        $this->assertDatabaseHas('items', [
            'updated_by' => $this->user->id,
        ]);
    }

    public function test_delete_item()
    {
        $this->bootWithTestUser();

        $item = Item::factory()->create($this->validData());
       
        $response = $this->json('DELETE', "/items/{$item->id}");

        $response->assertRedirect();
       
        // $this->assertSoftDeleted('items', ['id' => $item->id]);
    }
  
}
