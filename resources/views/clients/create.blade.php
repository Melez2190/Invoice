@extends('layouts.app')

@section('content')


<div class="m-auto w-4/8 py-8" >
    <div class="text-center">
        <h2 class="text-3xl uppercase bold">
            Add new client
        </h2>

    </div>
</div>
<div class="flex justify-center pt-2" >

    <form action="/clients/store" method="POST">
        @csrf
        <div class="block">
            
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="name"
                placeholder="Name" >
                @if($errors->has('name'))
                    <p class="text-xs text-red-500">{{ $errors->first('name') }}</p>
                @endif
               
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="city"
                placeholder="City" >
                @if($errors->has('city'))
                    <p class="text-xs text-red-500">{{ $errors->first('city') }}</p>
                @endif
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="address"
                placeholder="Address" >
                @if($errors->has('address'))
                <p class="text-xs text-red-500">{{ $errors->first('address') }}</p>
            @endif
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="account_number"
                placeholder="Account number" >
                @if($errors->has('account_number'))
                    <p class="text-xs text-red-500">{{ $errors->first('account_number') }}</p>
                @endif
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="id_number"
                placeholder="Id number" >
                @if($errors->has('id_number'))
                    <p class="text-xs text-red-500">{{ $errors->first('id_number') }}</p>
                @endif
            <input
                type="integer"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="tax_number"
                placeholder="Tax number" >
                @if($errors->has('tax_number'))
                    <p class="text-xs text-red-500">{{ $errors->first('tax_number') }}</p>
                @endif
            <input
                type="integer"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="zip_code"
                placeholder="Zip Code" >
                @if($errors->has('zip_code'))
                <p class="text-xs text-red-500">{{ $errors->first('zip_code') }}</p>
            @endif
               
            <input
                type="email"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="email"
                placeholder="Email" >
                @if($errors->has('email'))
                <p class="text-xs text-red-500">{{ $errors->first('email') }}</p>
            @endif
            <input
                type="integer"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="phone_number"
                placeholder="Phone number" >
                @if($errors->has('phone_number'))
                <p class="text-xs text-red-500">{{ $errors->first('phone_number') }}</p>
            @endif

            <button type="submit" class="bg-green-500 block text-white shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                Add
            </button>
            
        </div>
    </form>
</div>

@endsection