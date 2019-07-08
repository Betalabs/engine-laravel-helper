<?php


namespace Betalabs\LaravelHelper\Tests\Feature\Configuration;


use Betalabs\LaravelHelper\Http\Requests\ConfigurationRequestInterface;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\App\Configuration\ShowInterface;
use Betalabs\LaravelHelper\Services\App\Configuration\UpdateInterface;
use Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface;
use Betalabs\LaravelHelper\Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

class UpdateTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        Route::prefix('api')
            ->middleware('api')
            ->namespace('\Betalabs\LaravelHelper\Http\Controllers')
            ->group('routes/base.php');
        Passport::actingAs(factory(Tenant::class)->create());
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();

        App::bind(ConfigurationStructureInterface::class, ConfigurationStructureMock::class);
        App::bind(ShowInterface::class, MockShowService::class);
        App::bind(ConfigurationRequestInterface::class, MockConfigurationRequest::class);
        App::bind(UpdateInterface::class, MockUpdateService::class);

        $data = [
            'config' => 'value'
        ];

        $response = $this->json('PUT', 'api/configurations/21', $data);
        $response->assertStatus(200);

        $expectedData = [
            [
                'key' => 'config',
                'value' => 'value'
            ]
        ];

        $response->assertJson([
            'data' => $expectedData
        ]);
    }
}