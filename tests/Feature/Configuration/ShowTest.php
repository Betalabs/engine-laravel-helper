<?php


namespace Betalabs\LaravelHelper\Tests\Configuration;


use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\App\Configuration\ShowInterface;
use Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface;
use Betalabs\LaravelHelper\Tests\Feature\Configuration\ConfigurationStructureMock;
use Betalabs\LaravelHelper\Tests\Feature\Configuration\MockShowService;
use Betalabs\LaravelHelper\Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

class ShowTest extends TestCase
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

    public function testShow()
    {
        App::bind(ConfigurationStructureInterface::class, ConfigurationStructureMock::class);
        App::bind(ShowInterface::class, MockShowService::class);

        $key = 'config';
        $value = 'value';

        $response = $this->json('get', 'api/configurations/12');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                [
                    'key' => $key,
                    'value' => $value,
                ]
            ]
        ]);
    }
}