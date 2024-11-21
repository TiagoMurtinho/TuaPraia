<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $districts = [
            [
                'name' => 'Distrito 1',
                'regions_id' => 1,
            ],

            [
                'name' => 'Distrito 2',
                'regions_id' => 2
            ]
        ];

        foreach ($districts as $districtData) {
            District::create($districtData);
        }
    }
}
