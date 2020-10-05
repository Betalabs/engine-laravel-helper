<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('code');
            $table->string('slug');
            $table->unsignedInteger('tenant_id');

            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants');
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

        Schema::table('engine_channels', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
        });

        Schema::dropIfExists('engine_channels');
    }
}
