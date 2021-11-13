@extends('layouts.app')

@section('content')

<div class="ml-48">
    <div class="mb-12">

        <p> <strong> User: </strong> {{ $user->name }}</p>
       <p> <strong> Email: </strong> {{ $user->email }}</p>

    </div>
    <table class="mb-12 w-full">
        
        <form class="mb-8" action="/user/stats" method="GET">
            <thead class="mb-6">
                <tr class=" mb-8">
                  <th class="text-left">
                    From date of issue
                  </th>
                  <th class="text-left">
                    To date of issue
                  </th>
                  
                </tr>
               </thead>
               <tbody class="">
                <tr>
                    
                    <td class="ml-8">
                        <input type="date" name="date_of_issue" placeholder="Search date of issue" class="mb-8 mt-6 p-2 text-right"  value="{{ request('date_of_issue') }}">
                    </td>
                    <td>
                        <input type="date" name="to_date_of_issue" placeholder="Search date of issue" class="mb-8 mt-6 p-2" value="{{ request('to_date_of_issue') }}">
                    </td>
                    <td>
                        <input type="date" name="valuta"  class="mb-8 mt-6 p-2" value="{{ request('valuta') }}">
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



    <table class="border w-full">
        <thead>
            <tr aria-colspan="3">
                <th class="border text-right">   
                             Total income
                </th>
                <th class="border text-right">   
                    Total not paid
                </th>
                <th class="border text-right">
                    Expired invoices
                </th>
            </tr>

            
        </thead>
        <tbody class="">
            <tr>
                
                <td class="text-green-500 text-right border p-4">
                   {{ number_format((float) $paid, 2 )  }} <span class=""> rsd </span>
                   

                </td>
                <td class="text-red-500 content-end text-right border p-4">
                    {{ number_format((float) $notpaid, 2 ) }} <span class=""> rsd </span>


               </td>
               <td>
                   {{ $invoicesValuta }}
               </td>

            </tr>
        </tbody>
    </table>
    <table class="mt-8 border w-full">
        <thead>
            <tr class="">
                <th  class="border text-right">Total clients</th>
                <th class="border text-right">Number of not paid invoice</th>
                <th class="border text-right">Number of paid invoice</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-right border p-4">{{ $countclient }}</td>
                <td class="text-right border p-4">{{ $totalpaidinv }}</td>
                <td class="text-right border p-4">{{ $totalnotpaid }}</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection