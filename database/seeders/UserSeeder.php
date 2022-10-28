<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Team;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         return [tap(User::factory()->create([
            'name' => 'Romano',
            'email' => 'romano1@live.nl',
            'password' => Hash::make('Test12345'),
        ]), function(User $user) {
            $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => 'Personal',
                'personal_team' => true,
            ]));
        }),
        tap(User::factory()->create([
            'name' => 'HalloWereld',
            'email' => 'doeihallo575@gmail.com',
            'password' => Hash::make('Test12345'),
        ]), function(User $user) {
            $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => 'Personal',
                'personal_team' => true,
            ]));
        }),
    ];
    }
}
