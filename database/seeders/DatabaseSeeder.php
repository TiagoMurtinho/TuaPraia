<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\District;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //$this->call(RegionSeeder::class);
        //$this->call(DistrictSeeder::class);
        $this->call(AttributeSeeder::class);
        //$this->call(LocalSeeder::class);
        //$this->call(LocalAttributeSeeder::class);
    }
}
