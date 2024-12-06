<?php

namespace Database\Seeders;

use App\Models\Flag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flags = ['red', 'green', 'yellow'];

        foreach ($flags as $color) {
            Flag::create(['color' => $color, 'clicks' => 0]);
        }
    }
}
