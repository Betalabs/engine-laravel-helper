<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\NFe\TaxInvoice\Indexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\ResourceIndexer;
use Laravel\Passport\Passport;

class TaxInvoiceIndexerTest extends TestCase
{
    private $tenant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tenant = factory(Tenant::class)->create();
        Passport::actingAs($this->tenant);
        factory(EngineRegistry::class)->create(['tenant_id' =>  $this->tenant]);
    }

    public function testIndex()
    {
        $orderId = 2;
        $registryId = 1;

        ResourceIndexer::shouldReceive('setEndpoint')
            ->once()
            ->with('apps/{registryId}/wormhole/tax-invoices')
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setExceptionMessage')
            ->once()
            ->with('engine-laravel-helper::exception.apps/{registryId}/wormhole/tax-invoices.retrieve')
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setEndpointParameters')
            ->with([
                'registryId' => $registryId
            ])
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setQuery')
            ->once()
            ->withArgs(function ($arg) use($orderId) {
                return
                    $arg['code'] == $orderId &&
                    $arg['cStat_id'] == 100 &&
                    $arg['_filter-approach'] == 'and';
            })
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setLimit')
            ->once()
            ->with(null)
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('retrieve')
            ->once()
            ->andReturn(collect());

        /**@var Indexer $taxInvoice **/
        $taxInvoice = resolve(Indexer::class);
        $taxInvoice->setRegistryId($registryId)
            ->byOrderId($orderId)
            ->and()
            ->authorized()
            ->index();
    }
}
