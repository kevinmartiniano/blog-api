<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->longText('content');

            $table->unsignedBigInteger('created_id')->unsigned()->nullable();
            $table->unsignedBigInteger('modified_id')->unsigned()->nullable();

            $table->foreign("created_id")->references("id")->on("users")->onDelete("set null");
            $table->foreign("modified_id")->references("id")->on("users")->onDelete("set null");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
