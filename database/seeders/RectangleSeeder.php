<?php

namespace Database\Seeders;

use App\Models\Rectangle;
use Illuminate\Database\Seeder;

class RectangleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rectangle::factory()->create([
            'object_id' => 3,
        ]);
    }
}
