<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('Password1234'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'User 1',
                'email' => 'user@user.com',
                'password' => bcrypt('Password1234'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);

        DB::table('clients')->insert([
            [
                'firstName' => 'Max',
                'lastName' => 'Vergeetachtig',
                'gender' => 'male',
                'street' => 'Kartonnendoos straat',
                'houseNumber' => '1',
                'zipCode' => '1234 AB',
                'town' => 'Niemandsstad',
                'country' => 'The Netherlands',
                'user_id' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
