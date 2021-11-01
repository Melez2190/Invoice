<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Receipt</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .main{
            width: 100%;
            
        }
        .main-head{
            display: inline;
        }
        .main-info{
            float: right;
            margin-left: 60%;

        }
        .main-left{
            float: left;
            /* display: inline; */
        }
        
        .main-title{
            
            /* margin-top: 4rem; */
            margin-left: 6.5rem;
            font-size: 3rem;
            line-height: 1rem;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="main-head">
            <div class="main-left">
            <h6>ID invoice : <span>{{ $invoices->id}}</span></h6>
            <h6>ID invoice : <span>{{ $invoices->data_of_issue}}</span></h6>
            <h6>ID invoice : <span>{{ $invoices->valuta}}</span></h6>
            </div>
            <div class="main-title">
                Receipt
            </div>
            <div class="main-info">
                <table>
                    <tr>
                        <th >
                            Client
                        </th>
                        <td  >
                <strong>{{ $invoices->client->name }} </strong>
    
                        </td>
                    </tr>
                    <tr >
                        <th >
                            City
                        </th>
                        <td >
                <p>{{ $invoices->client->city }} </p>
    
                        </td>
                    </tr>
                    <tr>
                        <th >
                            Address
                        </th>
                        <td >
                <p>{{ $invoices->client->address }} </p>
    
                        </td>
                    </tr>
                    <tr>
                        <th >
                            Email
                        </th>
                        <td >
                <strong>{{ $invoices->client->email }} </strong>
    
                        </td>
                    </tr>
                    <tr>
                        <th >
                            Phone Number
                        </th>
                        <td >
                <p>{{ $invoices->client->phone_number }} </p>
    
                        </td>
                    </tr>
                    <tr>
                        <th >
                            Tax Number
                        </th>
                        <td >
                <p>{{ $invoices->client->tax_number }} </p>
    
                        </td>
                    </tr>
                    <tr>
                        <th >
                            Id Number
                        </th>
                        <td >
                <p>{{ $invoices->client->id_number }} </p>
    
                        </td>
                    </tr>
                    <tr>
                        <th >
                            Account number
                        </th>
                        <td >
                <strong>{{ $invoices->client->account_number }} </strong>
    
                        </td>
                    </tr>
                </table>

            </div>
        </div>
      
    </div>
</body>
</html>

{{ $invoices->id }}
@foreach ($items as $item)
{{ $item->quantity }}
{{ $item->price }}
{{ $item->pdv }}
@endforeach
