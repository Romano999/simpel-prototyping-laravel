<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PageSeeder::class,
            PageObjectSeeder::class,
            TextBoxSeeder::class,
            ImageSeeder::class,
            RectangleSeeder::class,
            CircleSeeder::class,
            TriangleSeeder::class,
        ]);
    }
}
