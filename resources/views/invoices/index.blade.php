@extends('layouts.app')

@section('content')

@foreach ($invoices as $invoice)

<div class="ml-44">
   
    <table class="w-full table-fixed border-separate  border border-solid border-black-800 my-4">
        


        <thead>
            <tr class="text-left border-b-6 p-4">
                <th class="border-separate border-b-2">Company name</th>
                <th class="border-b-2">Date of Issue</th>
                <th class="border-b-2">Valuta</th>
                <th class="border-b-2">Paid status</th>
                
              
            </tr>
        </thead>
        <tr>
          
          
            <td class=" text-left m-2 border-separate border-b-2"><a href="clients/{{ $invoice->client->id }}" > {{ $invoice->client->name }} </a></td>
                
            
        
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
              <form action="/invoices/{{ $invoice->id }}" method="POST" >
               
                @csrf
                @method('PUT')
            <input name="status" type="hidden" value="@if ($invoice->status === 1)
                0 
                @else
                1
            @endif">  <button name="btn-status" type="submit" >
              Change
          </button> </form></a>
            </div>
          </div>
          
        </td>
        </tr>
            

        
            
      

    </table>
</div>

@endforeach
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