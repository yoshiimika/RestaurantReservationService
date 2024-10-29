<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Reservation;
use App\Mail\ReservationReminderEmail;

class SendReservationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation:send-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '当日の予約情報に基づいてリマインダーを送信する';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reservations = Reservation::whereDate('date', now())->get();

        foreach ($reservations as $reservation) {
            $user = $reservation->user;
            $qrCode = QrCode::format('png')
                    ->size(200)
                    ->generate(route('shop_owner.check', $reservation->id));
            $qrCodePath = storage_path('app/public/qrcodes/' . $reservation->id . '.png');
            file_put_contents($qrCodePath, $qrCode);

            Mail::to($user->email)->send(new ReservationReminderEmail($reservation, $qrCodePath));
        }
    }
}
