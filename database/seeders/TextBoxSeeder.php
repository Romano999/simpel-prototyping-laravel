<?php

namespace Database\Seeders;

use App\Models\TextBox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            "max_width" => 100,
        ]);

        TextBox::factory()->create([
            'object_id' => 2,
            "text" => "I am a text box!",
            "max_width" => 100,
            "font" => '30px sans-serif',
        ]);
    }
}
