<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $userTypes = factory(App\UserType::class, 1)->create();
        DB::table('user_types')->insert([
            'name' => 'Admin',
        ]);
        DB::table('user_types')->insert([
            'name' => 'Default',
        ]);
    }
}
