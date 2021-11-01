@extends('layouts.app')

@section('content')
<div class="ml-44">
  
    <table class="w-full table-fixed border-separate  border border-solid border-black-800 my-4">
        


        <form action="/invoices/update/{{ $invoice->id }}" method="POST">
            @csrf
           
            <div class="block">
                <input
                type="text"
                class="block shadow-5xl mt-10 mb-10 p-2 w-80 italic placeholder-gray-400"
                name="client"
                value="{{ $invoice->client->name }}"
                 >
                 <input
                 type="date"
                 class="block shadow-5xl mt-10 mb-10 p-2 w-80 italic placeholder-gray-400"
                 name="date_of_issue"
                  value="{{ $invoice->date_of_issue }}">
                  <input
                  type="date"
                  class="block shadow-5xl mt-10 mb-10 p-2 w-80 italic placeholder-gray-400"
                  name="valuta"
                   value="{{ $invoice->valuta }}">

       
        
            
         

              
   
        <button type="submit" name="btn-ostalo" class=" text-left m-2 border-separate border-b-2 bg-green-500 block text-white shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
            Add
        </button>
   
    </form>

        
            
      

    </table>
</div>
@endsection