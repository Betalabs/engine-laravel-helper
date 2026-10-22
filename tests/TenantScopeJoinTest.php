<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\BelongsToTenant as ModelsBelongsToTenant;
use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\EngineVirtualEntity;
use Betalabs\LaravelHelper\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Passport;

/**
 * Executes real queries joining two tenant-scoped tables: an unqualified
 * `tenant_id` makes the database reject the query as ambiguous
 */
class TenantScopeJoinTest extends TestCase
{
    public function testJoinBetweenTenantScopedTablesReturnsOnlyCurrentTenantRows()
    {
        $tenant = factory(Tenant::class)->create();
        $other = factory(Tenant::class)->create();

        factory(EngineRegistry::class)->create(['tenant_id' => $tenant->id, 'registry_id' => 1]);
        factory(EngineRegistry::class)->create(['tenant_id' => $other->id, 'registry_id' => 2]);
        factory(EngineVirtualEntity::class)->create(['tenant_id' => $tenant->id, 'code' => 'mine']);
        factory(EngineVirtualEntity::class)->create(['tenant_id' => $other->id, 'code' => 'theirs']);

        Passport::actingAs($tenant);

        $rows = EngineRegistry::query()
            ->join('engine_virtual_entities', 'engine_virtual_entities.tenant_id', '=', 'engine_registries.tenant_id')
            ->get(['engine_registries.registry_id', 'engine_virtual_entities.code']);

        $this->assertCount(1, $rows);
        $this->assertEquals(1, $rows->first()->registry_id);
        $this->assertEquals('mine', $rows->first()->code);
    }

    public function testModelsBelongsToTenantTraitQualifiesTenantId()
    {
        Passport::actingAs(factory(Tenant::class)->create());

        $sql = ModelsTraitStub::query()
            ->leftJoin('orders', 'orders.id', '=', 'models_trait_stubs.order_id')
            ->toSql();

        $this->assertStringContainsString('"models_trait_stubs"."tenant_id" = ?', $sql);
        $this->assertStringNotContainsString(' "tenant_id" = ?', $sql);
    }

    public function testModelsBelongsToTenantTraitDoesNotFilterGuests()
    {
        $sql = ModelsTraitStub::query()->toSql();

        $this->assertStringNotContainsString('tenant_id', $sql);
    }
}

class ModelsTraitStub extends Model
{
    use ModelsBelongsToTenant;

    protected $table = 'models_trait_stubs';
}
