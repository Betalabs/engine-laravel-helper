<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenantScopeTest extends TestCase
{
    public function testScopeQualifiesTenantIdWithTheTableName()
    {
        Auth::shouldReceive('id')->andReturn(7);

        $sql = ScopedStub::query()->toSql();

        $this->assertStringContainsString('"scoped_stubs"."tenant_id" = ?', $sql);
    }

    public function testScopeIsNotAmbiguousWhenJoiningAnotherTableWithTenantId()
    {
        Auth::shouldReceive('id')->andReturn(7);

        $query = ScopedStub::query()
            ->leftJoin('orders', 'orders.id', '=', 'scoped_stubs.order_id');

        $this->assertStringContainsString('"scoped_stubs"."tenant_id" = ?', $query->toSql());
        $this->assertStringNotContainsString(' "tenant_id" = ?', $query->toSql());
        $this->assertSame([7], $query->getBindings());
    }
}

class ScopedStub extends Model
{
    use BelongsToTenant;

    protected $table = 'scoped_stubs';
}
