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

        TextBox::factory()->create([
            'object_id' => 2,
            "text" => "I am a text box!",
            "font" => '30px sans-serif',
        ]);
    }
}
