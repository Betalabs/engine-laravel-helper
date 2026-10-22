<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\NFe\TaxInvoice\Indexer;
use Betalabs\LaravelHelper\Services\Tenant\Updater;
use Facades\Betalabs\LaravelHelper\Services\Engine\ResourceIndexer;
use Laravel\Passport\Passport;

/**
 * Tenants with more than one registry: bySlug() must pick the registry of
 * the slug, not the first registry of the tenant
 */
class EngineRegistryBySlugTest extends TestCase
{
    private $tenant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tenant = factory(Tenant::class)->create();
        Passport::actingAs($this->tenant);
    }

    public function testUpdaterSavesTokenInEngineRegistryWhenItIsNotTheFirstOne()
    {
        $this->createPassportPersonalClient();

        $nfe = $this->registry('nfe', 'nfe-token');
        $engine = $this->registry('engine', 'old-engine-token');

        (new Updater())->update($this->tenant, ['engine_api_access_token' => 'new-engine-token']);

        $this->assertEquals('new-engine-token', $engine->fresh()->api_access_token);
        $this->assertEquals('nfe-token', $nfe->fresh()->api_access_token);
    }

    public function testUpdaterWithoutEngineRegistryThrowsException()
    {
        $this->createPassportPersonalClient();

        $this->registry('nfe', 'nfe-token');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Engine registry (slug "engine") not found for the tenant');

        (new Updater())->update($this->tenant, ['engine_api_access_token' => 'new-engine-token']);
    }

    public function testUpdaterWithoutEngineTokenDoesNotTouchRegistries()
    {
        $this->createPassportPersonalClient();

        $engine = $this->registry('engine', 'engine-token');

        (new Updater())->update($this->tenant, ['name' => 'New name']);

        $this->assertEquals('engine-token', $engine->fresh()->api_access_token);
        $this->assertEquals('New name', $this->tenant->fresh()->name);
    }

    public function testTaxInvoiceIndexerUsesNfeRegistryWhenItIsNotTheFirstOne()
    {
        $this->registry('engine', 'engine-token', 10);
        $this->registry('nfe', 'nfe-token', 20);

        $this->expectTaxInvoiceRequestWithRegistryId(20);

        resolve(Indexer::class)->setRegistryId(99)->index();
    }

    public function testTaxInvoiceIndexerFallsBackToInformedRegistryWithoutNfeRegistry()
    {
        $this->registry('engine', 'engine-token', 10);

        $this->expectTaxInvoiceRequestWithRegistryId(99);

        resolve(Indexer::class)->setRegistryId(99)->index();
    }

    private function registry($slug, $token, $registryId = null)
    {
        return factory(EngineRegistry::class)->create(array_filter([
            'tenant_id' => $this->tenant->id,
            'slug' => $slug,
            'api_access_token' => $token,
            'registry_id' => $registryId,
        ]));
    }

    private function expectTaxInvoiceRequestWithRegistryId($registryId)
    {
        ResourceIndexer::shouldReceive('setEndpoint')
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setExceptionMessage')
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setEndpointParameters')
            ->once()
            ->with(['registryId' => $registryId])
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setQuery')
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setLimit')
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('retrieve')
            ->once()
            ->andReturn(collect());
    }
}
