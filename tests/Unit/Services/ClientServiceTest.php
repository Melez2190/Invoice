<?php   

namespace Tests\Unit\Services;

use App\Models\Client;
use App\Models\User;
use App\Repositories\ClientRepository;
use App\Services\ClientService;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class ClientServiceTest extends TestCase
{
    private ClientService $service;
    // private MockObject $repository;
    private \PHPUnit\Framework\MockObject\MockObject $repository;


    protected function setUp(): void
    {
        parent::setUp();
        // $this->repository = $this->createMock(ClientRepository::class);
            $this->repository = $this->getMockBuilder(ClientRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        // $this->repository = $this->getMockBuilder(ClientRepository::class)
        //                         ->disableOriginalConstructor()
        //                         ->getMock();
        // $nesto = $this->getMockBuilder(ClientRepository::class)
        //     ->disableOriginalConstructor()
        //     ->getMock();

        $this->service = new ClientService($this->repository);
    }

    /** @test */  
    public function user_can_store_clients()
    {
        
        $request = [
            'user_id' => '10',
            'name' => 'test name',
            'city' => 'test name',
            'address' => 'test name',
            'account_number' => '1233242',
            'id_number' => '1233242',
            'tax_number' => '1233242',
            'zip_code' => '1233242',
            'email' => 'test1321@testemail.com',
            'phone_number' => '06433242'
        ];

        $this->repository
            ->expects(self::once())
            ->method('store')
            ->with(
                $request
            )->will($this->returnValue(new Client($request)));


        $response = $this->service->store($request);
        // $this->assertTrue($response);
        $this->assertEquals('test name', $response->name);
        $this->assertInstanceOf( Client::class, $response);
       
    }

     /** @test */  
    public function user_can_update_clients()
    {
        $request = [
            'user_id' => '10',
            'name' => 'test name',
            'city' => 'test name',
            'address' => 'test name',
            'account_number' => '1233242',
            'id_number' => '1233242',
            'tax_number' => '1233242',
            'zip_code' => '1233242',
            'email' => 'test1321@testemail.com',
            'phone_number' => '06433242'
        ];

        $client = new Client([
            'user_id' => '10',
            'name' => 'test',
            'city' => 'test',
            'address' => 'test name',
            'account_number' => '12242',
            'id_number' => '12342',
            'tax_number' => '12242',
            'zip_code' => '1233242',
            'email' => 'test13@testemail.com',
            'phone_number' => '06433242'
        ]);

        $this->repository
            ->expects(self::once())
            ->method('update')
            ->with(
                $client,
                $request
            );

        $response = $this->service->update($client, $request);
        $this->assertNotFalse($response);
      
        // $response->assertStatus($response->status(), 200);

       
    }
}