<?php


namespace Betalabs\LaravelHelper\Http\Controllers;

use App\Http\Requests\StoreConfigRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use App\Http\Resources\Configuration;
use App\Services\Configuration\Update;
use App\Structures\ConfigurationStructure;
use Betalabs\LaravelHelper\Http\Requests\ConfigurationRequestInterface;
use Betalabs\LaravelHelper\Services\App\Configuration\ShowInterface;
use Betalabs\LaravelHelper\Services\App\Configuration\UpdateInterface;
use Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller;

class ConfigurationController extends Controller
{
    /**
     * Please, inject an implementation of ConfigurationStructureInterface in a Service Provider in order to work
     *
     * @param \Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface $structure
     * @return \Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface
     */
    public function index(ConfigurationStructureInterface $structure): ConfigurationStructureInterface
    {
        return $structure;
    }

    /**
     * Please, inject an implementation of ShowInterface in a Service Provider in order to work
     *
     * @param \Betalabs\LaravelHelper\Services\App\Configuration\ShowInterface $service
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(ShowInterface $service): JsonResource
    {
        return new JsonResource($service->show());
    }

    /**
     * Please, inject an implementation of UpdateInterface and ConfigurationRequestInterface
     * in a Service Provider in order to work
     *
     * @param \Betalabs\LaravelHelper\Services\App\Configuration\UpdateInterface $service
     * @param \Betalabs\LaravelHelper\Http\Requests\ConfigurationRequestInterface $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(
        UpdateInterface $service,
        ConfigurationRequestInterface $request
    ): JsonResource {
        return new JsonResource($service->update($request->all()));
    }

    /**
     * @return ConfigurationStructure
     */
    public function structureConfigs() : ConfigurationStructure
    {
        return new ConfigurationStructure();
    }

    /**
     * @param StoreConfigRequest $request
     * @return Configuration
     */
    public function showConfigs(StoreConfigRequest $request) : Configuration
    {
        return new Configuration($request);
    }

    /**
     * @param UpdateConfigurationRequest $request
     * @param Update $service
     * @return Configuration
     */
    public function updateConfigs(
        UpdateConfigurationRequest $request,
        Update $service
    ) : Configuration {
        $service->updateConfigurations($request->all());
        return new Configuration($request);
    }

}
