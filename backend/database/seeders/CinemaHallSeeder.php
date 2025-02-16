<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CinemaHall;

class CinemaHallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CinemaHall::create([
            'name' => 'Зал 1',
            'rows' => 12,
            'seats_per_row' => 10,
        ]);

        CinemaHall::create([
            'name' => 'Зал 2',
            'rows' => 12,
            'seats_per_row' => 10,
        ]);

        // Добавляйте больше залов по мере необходимости...
    }
}
