<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('news_item_id')->nullable();
            $table->foreign('news_item_id')
                ->references('id')
                ->on('news')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('set null');
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
        Schema::dropIfExists('news_categories');
    }
}
