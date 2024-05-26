<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();
        
        DB::table('users')->insert([
            'name' => 'test1',
            'email' => 'test1@mail.com',
            'password' => 'test1test1', // password
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
