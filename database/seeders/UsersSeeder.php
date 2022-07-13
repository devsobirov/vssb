<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
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
                'name' => 'XVSSB Administrator',
                'email' => 'xvssb@admin.com',
                'password' => Hash::make('ysauienx'),
                'remember_token' => Str::random(10)
            ],
            [
                'name' => 'Sobirov Otabek',
                'email' => 'devsobirov@gmail.com',
                'password' => Hash::make('coca-cola'),
                'remember_token' => Str::random(10)
            ],
            [
                'name' => 'Sobirov Zafar',
                'email' => 'breezesoft@support.com',
                'password' => Hash::make('costa-rica'),
                'remember_token' => Str::random(10)
            ],
        ];

        \DB::table('users')->insert($users);
    }
}
