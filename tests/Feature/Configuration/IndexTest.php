<?php


namespace Betalabs\LaravelHelper\Tests\Feature\Configuration;


use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface;
use Betalabs\LaravelHelper\Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

class IndexTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::prefix('api')
            ->middleware('api')
            ->namespace('\Betalabs\LaravelHelper\Http\Controllers')
            ->group('routes/base.php');
        Passport::actingAs(factory(Tenant::class)->create());
    }

    public function testIndex()
    {
        App::bind(ConfigurationStructureInterface::class, ConfigurationStructureMock::class);

        $response = $this->json('get', 'api/configurations');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'type' => 'form',
                'rules' => [
                    'config' => 'string'
                ],
                'labels' => [
                    'config' => 'label'
                ]
            ]
        ]);
    }
}
