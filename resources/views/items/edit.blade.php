
@extends('layouts.app')

@section('content')
<div class="ml-44">
<div class="flex justify-center p-4">
    <div class="border-b border-gray-200 shadow">
       
        <form action="{{ route('items.update', [$item->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            
        <table class="">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2  text-lefttext-xs text-gray-500 ">
                        <input type="hidden" name="invoice_id" value="{{ $invoice }}" >
                    </th>
                    <th class="px-4 py-2  text-left text-xs text-gray-500 ">
                        Description
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Quantity
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Price
                    </th>
                    <th class="px-4 py-2 text-left text-xs text-gray-500 ">
                        Tax
                    </th>
                   
                </tr>
            </thead>
            <tbody class="bg-white">
               
               
                
                <tr class="whitespace-nowrap">
                    <td class="px-6 py-4 text-sm text-gray-500">
                    </td>
                   
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            <input type="text" name="description" value="{{ $item->description }}">

                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">
                            <input type="integer" name="quantity"  value="{{ $item->quantity }}">

                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <input type="integer" name="price"  value="{{ $item->price }}">

                    </td>
                    <td class="px-6 py-4">
                        <input type="number" name="pdv"  value="{{ $item->pdv }}">

                    </td>
                    <td class="px-6 py-4">
                    <button type="submit" class="bg-blue-900 mt-8 block text-white shadow-5xl mb-10 p-2 w-24 uppercase font-bold">
                        Save
                    </button>
                    </td>
                </tr>
                
               
               
            </tbody>
        </table>
    </form>

    </div>
</div>
</div>

    @endsection