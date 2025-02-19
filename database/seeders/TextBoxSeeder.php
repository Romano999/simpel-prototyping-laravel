<?php

namespace Database\Seeders;

use App\Models\TextBox;
use Illuminate\Database\Seeder;

class TextBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TextBox::factory()->create([
            'object_id' => 1,
            "text" => "Hello world!",
        ]);
    }
}
