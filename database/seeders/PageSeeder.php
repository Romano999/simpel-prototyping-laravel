<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::factory()->create([
           'name' => 'Romano\'s first test page',
           'user_id' => 1,
           'team_id' => 1,
        ]);

        Page::factory()->create([
            'name' => 'Romano\'s second test page',
            'user_id' => 1,
            'team_id' => 1,
        ]);

        Page::factory()->create([
            'name' => 'Hallo\'s first test page',
            'user_id' => 2,
            'team_id' => 2,
        ]);
    }
}
