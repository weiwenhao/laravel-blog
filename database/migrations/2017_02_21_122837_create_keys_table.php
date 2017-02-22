<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('关键字名称');
            $table->timestamps();
        });

        Schema::create('article_key', function (Blueprint $table) {
            $table->integer('article_id');
            $table->integer('key_id');
            $table->primary(['article_id','key_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keys');
        Schema::dropIfExists('article_key');
    }
}
