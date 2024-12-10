<?php

namespace Database\Seeders;

use App\Models\Devotion;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DevotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Devotion::factory(30)->create();

        // Create a devotion for today and yesterday, if they don't yet exist
        if (!Devotion::whereDate('date', Carbon::now())->first()) {
            Devotion::factory(1)->create([
                'date' => Carbon::now(),
            ]);
        }

        if (!Devotion::whereDate('date', Carbon::now()->subDay())->first()) {
            Devotion::factory(1)->create([
                'date' => Carbon::now()->subDay(),
            ]);
        }
    }
}
