<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@siakur.kbb.go.id',
                'is_admin' => '1',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User',
                'email' => 'normal@siakur.kbb.go.id',
                'is_admin' => '0',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
