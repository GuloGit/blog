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
            $table->increments('id');
            $table->string('category_name');
            $table->timestamps();
            $table->string("title");
            $table->string('status')->nullable();
            $table->text("description");
            $table->text("text");
            $table->string("url")->unique();
            $table->string("image");
            $table->foreign('category_name')
                ->references('name')->on('categories')
                ->onDelete('restrict')
                ->onUpdate('cascade')
             ;
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

