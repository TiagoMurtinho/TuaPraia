<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Attribute 1'
            ],

            [
                'name' => 'Attribute 2'
            ],

            [
                'name' => 'Attribute 3'
            ]
        ];

        foreach ($attributes as $attributeData) {
            Attribute::create($attributeData);
        }
    }
}
