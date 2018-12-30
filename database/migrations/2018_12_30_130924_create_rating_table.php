<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('guest_id');
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onDelete('restrict')
                ->onUpdate('cascade')
            ;
            $table->foreign('guest_id')
                ->references('id')->on('guests')
                ->onDelete('restrict')
                ->onUpdate('cascade')
            ;
            $table->integer("like")->nullable();
            $table->integer("dislike")->nullable();

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
        Schema::dropIfExists('rating');
    }
}
