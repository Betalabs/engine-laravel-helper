<?php


namespace Betalabs\LaravelHelper;


use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacrosProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->createPipeEach();
        $this->createFirstOr();
    }

    private function createPipeEach(): void
    {
        Collection::macro('pipeEach', function ($callables, ?callable $errorHandler = null, bool $breakOnError = true) {
            return $this->map(function ($element) use ($callables, $errorHandler, $breakOnError) {

                if (!($callables instanceof Collection)) {
                    $callables = collect($callables);
                }

                $originalElement = $element;
                $callables->each(function (Closure $callable) use (
                    &$element,
                    $originalElement,
                    $errorHandler,
                    $breakOnError
                ) {
                    try {
                        $element = $callable($element, $originalElement) ?? $element;
                    } catch (\Exception $exception) {
                        if (isset($errorHandler)) {
                            $errorHandler($exception, $originalElement);
                        } else {
                            throw $exception;
                        }
                        return !$breakOnError;
                    }
                });

                return $element;

            });
        });
    }

    private function createFirstOr()
    {
        Collection::macro('firstOr', function (Closure $closure) {
            try {
                $first = $this->first();
                if(!$first) {
                    return $closure();
                }
            } catch (\Exception $exception) {
                return $closure();
            }
            return $first;
        });
    }
}