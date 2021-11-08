<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class EmailDemo extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;
    protected $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        view()->share(['invoices' => $this->invoice, 'items'=>$this->invoice->items,  'user'=>$this->invoice->client]);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.show');
        return $this->from(Auth::user()->email)
                ->attachData($pdf->output(), 'recipt.pdf')
                ->view('emails.demoMail');
       
    }
    // return $this->markdown('Email.demoEmail')
    // ->with('mailData', $this->mailData);
    // $invoice= Invoice::pdf($this->invoice->id);
}
