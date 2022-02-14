<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;
use App\Mail\EmailDemo;



class MailController extends Controller {
    
    public function sendEmail(Invoice $invoice) {

        $email = $invoice->client->email;

        Mail::to($email)->send(new EmailDemo($invoice));
        

    return redirect("/invoices")->with('Success');
    }

}