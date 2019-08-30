<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [[
            'id'             => 1,
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       => '$2y$10$Qjfonm.8v4Wk8GZO.1IDR.2RykjFgO/o49MgZFXLbJw/lguvi/C9S',
            'remember_token' => null,
            'created_at'     => '2019-08-27 10:02:02',
            'updated_at'     => '2019-08-27 10:02:02',
            'deleted_at'     => null,
        ]];

        User::insert($users);
    }
}
