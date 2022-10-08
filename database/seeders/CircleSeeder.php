<?php

namespace Database\Seeders;

use App\Models\Circle;
use Illuminate\Database\Seeder;

class CircleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Circle::factory()->create([
            'object_id' => 4,
        ]);
    }
}
