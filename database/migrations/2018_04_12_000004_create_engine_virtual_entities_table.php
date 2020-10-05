<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineVirtualEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_virtual_entities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tenant_id');
            $table->string('code')->index();
            $table->unsignedInteger('type_id');
            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants');
            $table->foreign('type_id')
                ->references('id')
                ->on('engine_virtual_entity_types');
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

        Schema::table('engine_virtual_entities', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropForeign(['type_id']);
        });

        Schema::dropIfExists('engine_virtual_entities');
    }
}
