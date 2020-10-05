<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppSlugColumnToEngineRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('engine_registries', function (Blueprint $table) {
            $table->string('slug')->default('engine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(\App::environment('testing') && config('database.default') == 'sqlite') {
            return;
        }

        Schema::table('engine_registries', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
