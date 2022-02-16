<h1>Poštovani {{ $client->name }}</h1>
{{-- {{ dd($invoice) }} --}}
{{-- {{ dd($invoices) }} --}}
<h1>Za vas je izdata faktura broj {{ $invoice->id }} , molimo Vas da izvrsite placanje pre {{ $invoice->valuta }} datuma</h1>