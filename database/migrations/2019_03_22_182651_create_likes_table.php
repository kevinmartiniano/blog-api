<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('like');

            $table->unsignedBigInteger("created_id")->unsigned()->nullable();
            $table->unsignedBigInteger("post_id")->unsigned()->nullable();
            $table->unsignedBigInteger("comment_id")->unsigned()->nullable();

            $table->foreign("created_id")->references("id")->on("users")->onDelete("set null");
            $table->foreign("post_id")->references("id")->on("posts")->onDelete("set null");
            $table->foreign("comment_id")->references("id")->on("comments")->onDelete("set null");

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
        Schema::dropIfExists('likes');
    }
}
