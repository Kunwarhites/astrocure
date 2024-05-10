<?php

namespace Database\Seeders;

use App\Models\BusinesHour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinesHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = config('appointments.days');

        foreach ($days as $day) {
            BusinesHour::query()->updateOrCreate([
                'day' => $day,
            ], [
                'from' => "09:00",
                'to' => "18:00",
                'step' => 30
            ]);
        }
    }
}
