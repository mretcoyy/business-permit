<?php

use App\Entities\User;
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
        $data = 
            [
              'name' => 'Admin',
              'full_address' => '',
              'contact_number' => null,
              'email' => 'admin@test.com',
              'role' => 1,
              'status' => 1,
              'password' => bcrypt('123pasok'),
            ];
        User::create($data);
    }
}
