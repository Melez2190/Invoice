@extends('layouts.app')

@section('content')

<div class="m-auto w-4/8 py-8" >
    <div class="text-center">
        <h2 class="text-3xl uppercase bold">
            Edit client
        </h2>

    </div>
</div>

<div class="flex justify-center pt-2" >

    <form action="/clients/update/{{ $clients->id }}" method="POST">
        
        @csrf
       
        <div class="block">
            <input
            type="text"
            class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
            name="name"
            value="{{ $clients->name }}" >
        <input
            type="text"
            class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
            name="city"
            value="{{ $clients->city }}" >
        <input
            type="text"
            class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
            name="address"
            value="{{ $clients->address }}">
        <input
            type="text"
            class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
            name="account_number"
            value="{{ $clients->account_number }}" >
        <input
            type="text"
            class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
            name="id_number"
            value="{{ $clients->id_number }}" >
        <input
            type="integer"
            class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
            name="tax_number"
            value="{{ $clients->tax_number }}" >
        <input
            type="integer"
            class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
            name="zip_code"
            value="{{ $clients->zip_code }}" >
           
        <input
            type="email"
            class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
            name="email"
            value="{{ $clients->email }}" >
        <input
            type="integer"
            class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
            name="phone_number"
            value="{{ $clients->phone_number }}" >

            <button type="submit" class="bg-green-500 block text-white shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                Add
            </button>
            
        </div>
    </form>
</div>

@endsection