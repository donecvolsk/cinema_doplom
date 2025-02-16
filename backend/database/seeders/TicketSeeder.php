<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::create([
            'session_id' => 1,
            'row' => 1,
            'seat' => 1,
            'type' => 'VIP',
            'qr_code' => 'QR_1234567890.png',
        ]);

        Ticket::create([
            'session_id' => 2,
            'row' => 2,
            'seat' => 2,
            'type' => 'VIP',
            'qr_code' => 'QR_1234567890.png',
        ]);

        Ticket::create([
            'session_id' => 3,
            'row' => 3,
            'seat' => 3,
            'type' => 'ordinary',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 4,
            'row' => 4,
            'seat' => 4,
            'type' => 'ordinary',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 5,
            'row' => 5,
            'seat' => 5,
            'type' => 'VIP',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 6,
            'row' => 6,
            'seat' => 6,
            'type' => 'VIP',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 7,
            'row' => 7,
            'seat' => 7,
            'type' => 'ordinary',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 8,
            'row' => 8,
            'seat' => 8,
            'type' => 'ordinary',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 9,
            'row' => 9,
            'seat' => 9,
            'type' => 'ordinary',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 10,
            'row' => 10,
            'seat' => 10,
            'type' => 'VIP',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 11,
            'row' => 11,
            'seat' => 11,
            'type' => 'VIP',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 12,
            'row' => 12,
            'seat' => 12,
            'type' => 'VIP',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 13,
            'row' => 13,
            'seat' => 13,
            'type' => 'ordinary',
            'qr_code' => 'QR_0987654321.png',
        ]);

        Ticket::create([
            'session_id' => 14,
            'row' => 13,
            'seat' => 13,
            'type' => 'ordinary',
            'qr_code' => 'QR_0987654321.png',
        ]);
    
        Ticket::create([
            'session_id' => 15,
            'row' => 13,
            'seat' => 13,
            'type' => 'ordinary',
            'qr_code' => 'QR_0987654321.png',
        ]);
        // Добавляйте больше билетов по мере необходимости...
    }
}
