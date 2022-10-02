<?php

namespace Database\Seeders;

use App\Models\PageObject;
use Illuminate\Database\Seeder;

class PageObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageObject::factory()->create([
            'page_id' => 1,
            'pos_x' => 100,
            'pos_y' => 100,
            'object_type' => 'text_box',
        ]);

        PageObject::factory()->create([
            'page_id' => 1,
            'pos_x' => 200,
            'pos_y' => 200,
            'object_type' => 'image',
        ]);

        PageObject::factory()->create([
            'page_id' => 1,
            'pos_x' => 300,
            'pos_y' => 300,
            'object_type' => 'rectangle',
        ]);

        PageObject::factory()->create([
            'page_id' => 1,
            'pos_x' => 400,
            'pos_y' => 400,
            'object_type' => 'circle',
        ]);

        PageObject::factory()->create([
            'page_id' => 1,
            'pos_x' => 500,
            'pos_y' => 500,
            'object_type' => 'triangle',
        ]);
    }
}
