
@extends('layouts.app')

@section('content')

<div class="ml-44">
<div class="text-center w-full">
    <table class="w-full border ">
        <thead class="text-left border">
            <tr>
                <th>
                    Company name
                </th>
                <th>
                    <Address>
                        Address
                    </Address>
                </th>
                <th>
                    City
                </th>
                <th>
                    Tax Number:
                </th>
                <th>
                    ID number:
                </th>
                <th>
                    Email:
                </th>
                <th>
                    Phone number
                </th>
                <th>
                    For paid
                </th>
            </tr>
        </thead>
        <tbody class="text-left h-12">
            <tr class="p-12">
                <td>
                    {{ $client->name }}
                </td>
                <td>
                    {{ $client->address }}
                </td>
                <td>
                    {{ $client->city }}
                </td>
                <td>
                    {{ $client->tax_number }}
                </td>
                <td>
                    {{ $client->id_number }}
                </td>
                <td>
                    {{ $client->email }}
                </td>
                <td>
                    {{ $client->phone_number }}
                </td>
                <td>
                   
                </td>
            </tr>
        </tbody>
  
    
</table>
</div>


@endsection