<?php   

namespace Tests\Unit\Services;

use App\Models\Invoice;
use App\Models\User;
use App\Repositories\InvoiceRepository;
use App\Services\InvoiceService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class InvoiceServiceTest extends TestCase
{
    private InvoiceService $service;
    private \PHPUnit\Framework\MockObject\MockObject $repository;


    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getMockBuilder(InvoiceRepository::class)
        ->disableOriginalConstructor()
        ->getMock();
      

        $this->service = new InvoiceService($this->repository);
    }

    /** @test */  
    public function user_can_store_invoice()
    {
        Event::fake();
        $request = [
            'client_id' => '2',
            'date_of_issue' => '2022-03-09',
            'valuta'  => '2022-04-15',
            'status' => 0,
        ];

        $this->repository
            ->expects(self::once())
            ->method('store')
            ->with(
                $request
            )->willReturn($this->returnValue(new Invoice($request)));


        $response = $this->service->store($request);

        $this->assertEquals('2022-03-09', $response->date_of_issue);
        $this->assertInstanceOf( Invoice::class, $response);
       
    }

     /** @test */  
    public function user_can_update_invoice()
    {
        $request = [
            'client_id' => '2',
            'date_of_issue' => '2022-03-09',
            'valuta'  => '2022-04-15',
            'status' => 0,
        ];

        $invoice = new Invoice([
            'client_id' => '2',
            'date_of_issue' => '2021-03-10',
            'valuta'  => '2024-04-22',
            'status' => 1,
        ]);

        $this->repository
            ->expects(self::once())
            ->method('update')
            ->with(
                $invoice,
                $request
            )->will($this->returnValue(new Invoice($request)));

        $response = $this->service->update($invoice, $request);
        // dd($response->date_of_issue);
        $this->assertNotFalse($response);
        $this->assertEquals('2022-03-09', $response->date_of_issue);
      
        // $response->assertStatus($response->status(), 200);

       
    }
}