<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novels', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('headline')->nullable();
            $table->integer('format_id');
            $table->mediumText('body');
            $table->integer('published')->default(0);
            $table->timestamps();
            $table->integer('del_flg')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novels');
    }
}
