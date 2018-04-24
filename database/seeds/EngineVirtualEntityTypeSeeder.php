<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EngineVirtualEntityTypeSeeder extends Seeder
{
    use DatabaseTimestamps;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('engine_virtual_entity_types')->insert(array_merge(['id' => 1, 'name' => 'Product'], $this->timestamps()));
        DB::table('engine_virtual_entity_types')->insert(array_merge(['id' => 2, 'name' => 'Shipping company'], $this->timestamps()));
    }
}
