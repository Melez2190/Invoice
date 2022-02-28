<?php   

namespace Tests\Unit\Services;

use App\Models\Item;
use App\Models\User;
use App\Repositories\ItemRepository;
use App\Services\ItemService;
use Tests\TestCase;

class ItemServiceTest extends TestCase
{
    private ItemService $service;
    private \PHPUnit\Framework\MockObject\MockObject $repository;


    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getMockBuilder(ItemRepository::class)
        ->disableOriginalConstructor()
        ->getMock();
      

        $this->service = new ItemService($this->repository);
    }

    /** @test */  
    public function user_can_store_Item()
    {
        $request = [
            'invoice_id' => '5',
            'description' => 'Test opis',
            'price'=> '100',
            'quantity' => '1000',
            'pdv' => 18,
        ];

        $this->repository
            ->expects(self::once())
            ->method('store')
            ->with(
                $request
            )->willReturn($this->returnValue(new Item($request)));


        $response = $this->service->store($request);

        $this->assertEquals('Test opis', $response->description);
        $this->assertInstanceOf( Item::class, $response);
       
    }

     /** @test */  
    public function user_can_update_Item()
    {
        $request = [
            'invoice_id' => '5',
            'description' => 'Update opis',
            'price'=> '100',
            'quantity' => '1000',
            'pdv' => 18,
        ];

        $item = new Item([
            'invoice_id' => '5',
            'description' => 'Test opis',
            'price'=> '100',
            'quantity' => '1000',
            'pdv' => 18,
        ]);

        $this->repository
            ->expects(self::once())
            ->method('update')
            ->with(
                $item,
                $request
            )->will($this->returnValue(new Item($request)));

        $response = $this->service->update($item, $request);
        $this->assertNotFalse($response);
        $this->assertEquals('Update opis', $response->description);
      
    }
}