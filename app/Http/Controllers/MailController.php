<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;
use App\Models\Item;
use App\Mail\EmailDemo;



class MailController extends Controller {
    
    public function sendEmail(Invoice $invoice) {

        $email = $invoice->client->email;
  
        Mail::to($email)->send(new EmailDemo($invoice));
   
    //     return response()->json([
    //         'message' => 'Email has been sent.'
    //     ], Response::HTTP_OK);
    // }
    return redirect("/invoices")->with('Success');
    }

}