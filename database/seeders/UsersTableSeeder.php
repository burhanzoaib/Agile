<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'hashir.iqbal@gmail.com',
                'lname'=>"admin1",
                'password' => bcrypt('delldell'),
                'user_type' => 'admin',
            ]
        ];

        foreach($users as $user) {
            $user=User::create($user);
            $user->assignRole('admin');
        }
    }
}
