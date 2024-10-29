<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Swift_Image;

class ReservationReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $qrCodePath;
    public $qrCodeCid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation, $qrCodePath)
    {
        $this->reservation = $reservation;
        $this->qrCodePath = $qrCodePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->withSwiftMessage(function ($message) {
            $this->qrCodeCid = $message->embed(Swift_Image::fromPath($this->qrCodePath));
        });
        return $this->markdown('emails.reservation-reminder')
                    ->subject('予約リマインダーメール')
                    ->with([
                        'reservation' => $this->reservation,
                        'qrCodeCid' => $this->qrCodeCid,
                    ]);
    }
}
