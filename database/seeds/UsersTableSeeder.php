<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users = factory(User::class, 1)->create();
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'user_type_id' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'default',
            'email' => 'default@example.com',
            'password' => bcrypt('12345678'),
            'user_type_id' => 2,
        ]);
    }
}
