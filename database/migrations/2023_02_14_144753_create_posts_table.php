<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('ref');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('initiator_id');
            $table->unsignedBigInteger('validator_id')->nullable();
            $table->string('title',125);
            $table->boolean('status')->default(false);
            $table->string('slug')->nullable();
            $table->text('content');
            $table->string('banner');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('initiator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('validator_id')->references('id')->on('users')->onDelete('cascade');
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
