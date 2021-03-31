<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $utilities = [
//            ['name' => 'Senior', 'email' => 'senior@gmail.com', 'password' => bcrypt('secret'), 'phone' => '0356240993'],
            ['name' => 'User2021', 'email' => 'user@gmail.com', 'password' => bcrypt('123456'),]
        ];

        \DB::table("users")->insert($utilities);

    }
}
