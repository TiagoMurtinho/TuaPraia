<?php

namespace Database\Seeders;

use App\Models\LocalAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $localsAttributes = [
            [
                'locals_id' => 1,
                'attributes_id' => 1,
            ],

            [
                'locals_id' => 2,
                'attributes_id' => 2,
            ],

            [
                'locals_id' => 3,
                'attributes_id' => 1,
            ],

            [
                'locals_id' => 1,
                'attributes' => 2,
            ]
        ];

        foreach ($localsAttributes as $localAttributeData) {
            LocalAttribute::insert($localAttributeData);
        }
    }
}
