@extends('layouts.app')

@section('content')


<div class="ml-48">
   
       <table class="mb-12 w-full">
        
      <form class="mb-8" action="{{ route('invoices.index') }}" method="GET">
        <thead class="mb-6">
         <tr class=" mb-8">
           <th class="text-left">
             <p>Company name<p>
           </th>
           <th class="text-left">
             From date of issue
           </th>
           <th class="text-left">
             To date of issue
           </th>
           <th class="text-left">
             From date valuta
           </th>
           <th class="text-left">
             To date valuta
           </th>
         </tr>
        </thead>
        <tbody class="">
          <tr>
            <td>
        <input class="w-36 mb-8 mt-6 p-2" type="text" name="client_name" placeholder="Search company" value="{{ request('client_name') }}">

            </td>
            <td class="ml-8">
            
              <input type="date" name="date_of_issue"  class="mb-8 mt-6 p-2 text-right"  value="{{ request('date_of_issue') }}">
            </td>
            <td>
              <input type="date" name="to_date_of_issue"  class="mb-8 mt-6 p-2" value="{{ request('to_date_of_issue') }}">
            </td>
            <td>
              <input type="date" name="valuta" placeholder="Search date-valuta" class="mb-8 mt-6 p-2" value="{{ request('valuta') }}">
            </td>
            <td>
              <input type="date" name="tovaluta" placeholder="Search date-valuta" class="mb-8 mt-6 p-2" value="{{ request('tovaluta') }}">
            </td>
            <td>
              <button type="submit" class="bg-green-500 text-white shadow-5xl ml-2 mb-2 p-2 w-24 uppercase font-bold" name="status_true" value="1"> PAID </button>
            </td>
            <td>
              <button type="submit" class="bg-red-500 ml-2 mr-2 text-white shadow-5xl mb-2 p-2 w-24 uppercase font-bold" name="status" value="{{ 0 }}"> NOT PAID </button>
            </td>
            <td>
              <button type="submit" class="bg-blue-900 text-white shadow-5xl mb-2 p-2 w-24 uppercase font-bold">
                Search
              </button>
            </td>
          </tr>
        </tbody>
       
       
       
        
        
       
       
      </form>
    </table>
    <table class="w-full table-fixed border-separate  border border-solid border-black-800 my-4">

        <thead>
            <tr class="text-left border-b-6 p-4">
                <th class="border-separate border-b-2">Company name</th>
                <th class="border-b-2">Date of Issue</th>
                <th class="border-b-2">Valuta</th>
                <th class="border-b-2">Paid status</th>
                
              
            </tr>
        </thead>
@foreach ($invoices as $invoice)


        <tr>
          
          
            <td class=" text-left m-2 border-separate border-b-2"><a href="/clients/{{ $invoice->client->id }}" >
               {{ $invoice->client->name }} </a></td>
                
            
        
            <td class=" text-left m-2 border-separate border-b-2">{{ $invoice->date_of_issue }}</td>
            <td class=" text-left m-2 border-separate border-b-2">{{ $invoice->valuta }}</td>
            
            <td class=" text-left m-2 border-separate border-b-2">
                @if($invoice->status )
                    <span class="text-green-700">Paid</span>
                @else
                    <span class="text-red-700">Not paid</span>
                

             @endif
        </td>
        <td><div class="dropdown">
            <button class="dropbtn">Actions</button>
            <div class="dropdown-content">
            <a href="/invoices/{{ $invoice->id }}/edit">Edit</a>
            <a href="/invoices/{{ $invoice->id }}">View</a>
            <a href="/invoices/{{ $invoice->id }}/edit">
              <form action="{{ route('invoices.update', [$invoice->id]) }}" method="POST" >
               
                @csrf
                @method('PATCH')
            <input name="status" type="hidden" value="@if ($invoice->status === 1)
                0 
                @else
                1
            @endif">  
            <button name="btn-status" type="submit" >
              Change
            </button> 

          </form></a>
          <form action="{{ route('invoices.destroy', [$invoice->id]) }}" method="POST">
            @csrf
            @method('DELETE')   
            <a href=""><input type="submit" value="Delete" ></a>
          
        </form>
            </div>
          </div>
          
        </td>

        </tr>
@endforeach

            

        
            
      

    </table>
</div>
<div class="w-96 mr-12 float-right">
  {{ $invoices->links() }}

</div>

<script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
<script>
  function openDropdown(event,dropdownID){
    let element = event.target;
    while(element.nodeName !== "BUTTON"){
      element = element.parentNode;
    }
    var popper = Popper.createPopper(element, document.getElementById(dropdownID), {
      placement: 'bottom-end'
    });
    document.getElementById(dropdownID).classList.toggle("hidden");
    document.getElementById(dropdownID).classList.toggle("block");
  }
</script>

@endsection