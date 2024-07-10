<?php

namespace Database\Seeders;

use App\Models\Local;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locals = [
            [
                'name' => 'Local 1',
                'description' => 'Beautiful.',
                'coordinates' => '123ABC',
                'type' => 'beach',
                'districts_id' => 2,
                'regions_id' => 2,
            ],

            [
                'name' => 'Local 2',
                'description' => 'Not beautiful.',
                'coordinates' => 'ABC123',
                'type' => 'cascade',
                'districts_id' => 1,
                'regions_id' => 2,
            ],

            [
                'name' => 'Local 3',
                'description' => 'Amazing place.',
                'coordinates' => '987XYZ',
                'type' => 'fluvial',
                'districts_id' => 2,
                'regions_id' => 1,
            ]
        ];

        foreach ($locals as $localData) {
            Local::create($localData);
        }
    }
}
