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
            $table->unsignedInteger('company_id');
            $table->string('code')->index();
            $table->unsignedInteger('type_id');
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies');
            $table->foreign('type_id')
                ->references('id')
                ->on('engine_virtual_entity_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engine_virtual_entities', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['type_id']);
        });

        Schema::dropIfExists('engine_virtual_entities');
    }
}
