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
            'pos_x' => 300,
            'pos_y' => 300,
            'object_type' => 'text_box',
        ]);

        PageObject::factory()->create([
            'page_id' => 1,
            'pos_x' => 200,
            'pos_y' => 200,
            'object_type' => 'image',
        ]);
    }
}
