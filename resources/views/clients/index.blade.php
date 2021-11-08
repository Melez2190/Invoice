@extends('layouts.app')

@section('content')

<div class="ml-48">

  <table class="mb-12 w-full">
        
    <form class="mb-8" action="/clients/search" method="GET">
      <thead class="mb-6">
       <tr class=" mb-8">
         <th class="text-left">
           <p>Company name<p>
         </th>
         <th class="text-left">
          City
         </th>
         <th class="text-left">
           Email
         </th>
         <th class="text-left">
           Tax Number
         </th>
         <th class="text-left">
           ID number
         </th>
       </tr>
      </thead>
      <tbody class="">
        <tr>
          <td>
      <input class="w-36 mb-8 mt-6 p-2" type="text" name="client_name" placeholder="Search company" value="{{ request('client_name') }}">

          </td>
          <td class="ml-8">
          
            <input type="text" name="city" placeholder="City" class=" w-36 mb-8 mt-6 p-2"  value="{{ request('city') }}">
          </td>
          <td>
            <input type="text" name="email" placeholder="Email" class="w-36 mb-8 mt-6 p-2"  value="{{ request('email') }}">
          </td>
          <td>
            <input type="text" name="tax_number" placeholder="Tax number" class="w-36 mb-8 mt-6 p-2" value="{{ request('tex_number') }}">
          </td>
          <td>
            <input type="text" name="id_number" placeholder="Id number" class="w-36 mb-8 mt-6 p-2" value="{{ request('id_number') }}">
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

            <td class=" text-left m-2 border-separate border-b-2"><a href="/clients/{{ $client->id }}" > {{ $client->name }} </a></td>
        
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
                <form action="/clients/delete/{{ $client->id }}" method="POST">
                  @csrf
                 
                  <a href=""><input type="submit" value="Delete" ></a>
                
              </form>
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
<div class="w-96 float-right">
  {{ $clients->links() }}

</div>
@endsection