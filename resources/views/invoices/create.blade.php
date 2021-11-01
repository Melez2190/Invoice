@extends('layouts.app')

@section('content')

<div class="m-auto w-4/8 py-8" >
    <div class="text-center">
        <h2 class="text-3xl uppercase bold">
            Add new invoice
        </h2>

    </div>
</div>


<div class="flex justify-center pt-2" >

    <form action="/invoices/store" method="POST">
        
        @csrf
        
        
        <div class="block">
            
            <select name="client_id">
            @foreach ($clients as $client )

                <option class="block shadow-5xl mb-10 p-2" value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
                
            </select>
           
          
         
           
            <input
                type="date"
                class="block shadow-5xl mt-10 mb-10 p-2 w-80 italic placeholder-gray-400"
                name="date_of_issue"
                 />
                 @if($errors->has('date_of_issue'))
                    <p class="text-xs text-red-500">{{ $errors->first('date_of_issue') }}</div>
                 @endif
            <input
                type="date"
                class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                name="valuta"
                />
                @if($errors->has('valuta'))
                    <p class="text-xs text-red-500">{{ $errors->first('valuta') }}</div>
                @endif
           
            
            <button type="submit" class="bg-green-500 block text-white shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                Add
            </button>
            
        </div>
    </form>
</div>

@endsection