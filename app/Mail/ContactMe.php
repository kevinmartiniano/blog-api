<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

use PHPUnit\Framework\Exception;
use App\Model\Contact;

class ContactMe extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Config::get('mail.from.address'), Config::get('mail.from.name'))->view('emails.contact.admin')->with([
            'contactName' => $this->contact->name,
            'contactPhoneNumber' => $this->contact->phone_number,
            'contactEmail' => $this->contact->email,
            'contactMessage' => $this->contact->message,
        ]);
    }
}
