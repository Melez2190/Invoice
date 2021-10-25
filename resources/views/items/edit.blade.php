
@extends('layouts.app')

@section('content')
<div class="ml-44">
<div class="flex justify-center p-4">
    <div class="border-b border-gray-200 shadow">
        <form action="/items/{{ $item->id }}" method="POST">
            @csrf
            @method('PUT')
            
        <table class="">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2  text-lefttext-xs text-gray-500 ">
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}" >
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
                    <button type="submit" class="bg-blue-900 mt-8 block text-white shadow-5xl mb-10 p-2 w-12 uppercase font-bold">
                        Add
                    </button>
                    </td>
                </tr>
                
               
                {{-- <tr class="">
                    <td colspan="3"></td>
                    <td class="text-sm font-bold">Sub Total</td>
                    <td class="text-sm font-bold tracking-wider"><b>$950</b></td>
                </tr>
                <!--end tr-->
                <tr>
                    <th colspan="3"></th>
                    <td class="text-sm font-bold"><b>Tax Rate</b></td>
                    <td class="text-sm font-bold"><b>$1.50%</b></td>
                </tr>
                <!--end tr-->
                <tr class="text-white bg-gray-800">
                    <th colspan="3"></th>
                    <td class="text-sm font-bold"><b>Total</b></td>
                    <td class="text-sm font-bold"><b>$999.0</b></td>
                </tr> --}}
                <!--end tr-->

            </tbody>
        </table>
    </form>

    </div>
</div>
</div>

    @endsection