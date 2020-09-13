<?php

use Illuminate\Database\Seeder;
use App\Model\Like;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $likes = factory(Like::class, 20)->create();
    }
}
