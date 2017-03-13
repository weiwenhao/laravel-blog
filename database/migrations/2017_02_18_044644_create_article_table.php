<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title')->comment('文章标题');
            $table->string('seo_title')->index()->comment('seo优化标题');
            $table->string('description')->comment('文章描述');
            $table->text('content')->comment('文章内容');
            $table->timestamp('publish_at')->nullable()->index()->comment('文章发表时间');
            $table->tinyInteger('cat_id')->unsigned()->comment('分类id');
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
        Schema::dropIfExists('articles');
    }
}
