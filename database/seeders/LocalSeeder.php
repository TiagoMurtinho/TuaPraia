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
            ],

            [
                'name' => 'Local 2',
                'description' => 'Not beautiful.',
                'coordinates' => 'ABC123',
                'type' => 'cascade',
            ],

            [
                'name' => 'Local 3',
                'description' => 'Amazing place.',
                'coordinates' => '987XYZ',
                'type' => 'fluvial',
            ]
        ];

        foreach ($locals as $localData) {
            Local::create($localData);
        }
    }
}
