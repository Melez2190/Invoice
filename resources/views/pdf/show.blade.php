<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice </title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        th{
            text-align: left;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #60A7A6;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        .paid{
            color: green;
        }
        .notpaid{
            color: red
        }
        .client-info{
           text-align: right;
        }
        .client-text {
            text-align: right;
            font-size: 24px;
            font-weight: 900;
        }
        .table-border{
            border: 1px solid rgb(170, 167, 167);
            border-collapse: collapse;
        }
        .table-border th {
            border: 1px solid rgb(170, 167, 167);
            border-collapse: collapse;
        }
        .gray{
            background-color: rgb(100, 97, 97);
            color: white;
            padding: 2px
            
        }
        .table-data{
            border-bottom: 1px solid gray;
            
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <br /><br /> <br />
            <td align="left" style="width: 40%;">
                <h3>{{ $user->name }}</h3>
                <h4>{{ $user->email }}</h4>
             


<br />
Data of issue : {{ $invoices->date_of_issue }} <br />
Valuta : {{ $invoices->valuta }} <br />





Status: @if($invoices->status )
<span class="paid">Paid</span>
@else
<span class="notpaid">Not paid</span>

@endif

            </td>
            {{-- <td align="center">
                <img src="/path/to/logo.png" alt="Logo" width="64" class="logo"/>
            </td> --}}
            <td align="right" style="width: 30%;">

                <h3 class="client-info"><strong align="left" > Client: </strong></h3><p class="client-text" > {{ $invoices->client->name }}  </p>
              
                   <p class="client-info"><strong align="left" >Email: </strong>{{ $invoices->client->email }}</p>

                  <p class="client-info"> {{ $invoices->client->address }}</p>
                   <p class="client-info">{{ $invoices->client->city }}</p>
                  <p class="client-info"> <strong align="left" > Account Number: </strong> {{ $invoices->client->account_number }}</p>
                   <p class="client-info"><strong align="left" > ID Number: </strong>{{ $invoices->client->id_number }}</p>
               
            </td>
        </tr>

    </table>
</div>


<br/>

<div class="invoice">
    <h3>Invoice ID: {{ $invoices->id }}</h3>
    <table class="table-border" width="100%">
        <thead>
        <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Tax</th>
            <th>Total</th>
           
        </tr>
        </thead>
        @foreach ($items as $item)
            
        <tbody>
        <tr>
            <td class="table-data">{{ $item->description }}</td>
            <td class="table-data">{{ $item->quantity }}</td>
            <td class="table-data" align="left">{{ number_format((float) $item->price, 2 ) }}</td>

            <td class="table-data" align="left">{{ $item->pdv }}</td>
        
              
            <td class="table-data" align="left">{{ number_format((float) ($item->quantity * $item->price)+(($item->quantity * $item->price)/100)*$item->pdv, 2 ) }} rsd </td>
                  
              
                  
            
          
                
          
           

        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
        @endforeach

        <tfoot>
        <tr>
            <td  colspan="3"></td>
            <td align="left">Total: </td>
            <td align="left" class="gray">{{ number_format((float) $invoices->total(), 2 ) }} rsd</td>
        </tr>

        </tfoot>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                Company Slogan
            </td>
        </tr>

    </table>
</div>
</body>
</html>