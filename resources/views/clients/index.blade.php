@extends('layouts.app')

@section('content')

<div class="ml-44">
    <table class="w-full table-fixed border-separate  border border-solid border-black-800 my-4">
        

        <thead>
            <tr class="text-left border-b-6 p-4">
                <th class="border-separate border-b-2">Client</th>
                <th class="border-b-2">City</th>
                <th class="border-b-2 w-1/12">Address</th>
                <th class="border-b-2 w-2/12">Account Number</th>
                <th class="border-b-2">ID Number</th>
                <th class="border-b-2">Tax Number</th>
                <th class="border-b-2 w-2/12">Email</th>
  
                <th class="border-b-2">Phone number</th>
            </tr>
        </thead>
@foreach ($clients as $client )

        <tr>

            <td class=" text-left m-2 border-separate border-b-2"><a href="clients/{{ $client->id }}" > {{ $client->name }} </a></td>
        
            <td class=" text-left m-2 border-separate border-b-2">{{ $client->city }}</td>
            <td class=" text-left m-2 border-separate border-b-2">{{ $client->address }}</td>
            <td class=" text-left m-2 border-separate border-b-2">{{ $client->account_number }}</td>
            <td class=" text-left m-2 border-separate border-b-2">{{ $client->id_number }}</td>
            <td class=" text-left m-2 border-separate border-b-2">{{ $client->tax_number }}</td>
            <td class=" text-left m-2 border-separate border-b-2">{{ $client->email }}</td>
            <td class=" text-left m-2 border-separate border-b-2">{{ $client->phone_number }}</td>
            <td><div class="dropdown">
                <button class="dropbtn">Actions</button>
                <div class="dropdown-content">
                <a href="clients/{{ $client->id }}/edit">Edit</a>
                <a href="clients/{{ $client->id }}">View</a>
                <a href="#">Link 3</a>
                </div>
              </div>
              
            </td>
            
        </tr>
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
              
            


            

        
            

    </table>
</div>

@endsection