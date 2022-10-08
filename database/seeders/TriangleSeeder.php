<?php

namespace Database\Seeders;

use App\Models\Triangle;
use Illuminate\Database\Seeder;

class TriangleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Triangle::factory()->create([
            'object_id' => 5,
        ]);
    }
}
