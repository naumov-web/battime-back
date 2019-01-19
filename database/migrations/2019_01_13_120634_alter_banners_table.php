<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->renameColumn('redirectsCount', 'redirects_count');
            $table->text('company_name');
            $table->text('link');
            $table->unsignedInteger('place_id')->nullable();
            $table->boolean('is_enabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('is_enabled');
            $table->dropColumn('place_id');
            $table->dropColumn('link');
            $table->dropColumn('company_name');
            $table->renameColumn('redirects_count', 'redirectsCount');
        });
    }
}
