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

    <form action="/clients" method="POST">
        @csrf
        <div class="block">
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="name"
                placeholder="Name" >
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="city"
                placeholder="City" >
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="address"
                placeholder="Address" >
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="account_number"
                placeholder="Account number" >
            <input
                type="text"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="id_number"
                placeholder="Id number" >
            <input
                type="integer"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="tax_number"
                placeholder="Tax number" >
            <input
                type="integer"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="zip_code"
                placeholder="Zip Code" >
               
            <input
                type="email"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="email"
                placeholder="Email" >
            <input
                type="integer"
                class="block shadow-5xl mb-4 p-2 w-80 italic placeholder-gray-400"
                name="phone_number"
                placeholder="Phone number" >

            <button type="submit" class="bg-green-500 block text-white shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                Add
            </button>
            
        </div>
    </form>
</div>

@endsection