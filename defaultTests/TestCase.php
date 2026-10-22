<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\AbstractDumper;
use Symfony\Component\VarDumper\Dumper\CliDumper;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function refreshTestDatabase()
    {
        if (! RefreshDatabaseState::$migrated) {
            $this->artisan('migrate:fresh', [
                '--drop-views' => $this->shouldDropViews(),
                '--drop-types' => $this->shouldDropTypes(),
            ]);
            $this->artisan('seed');

            $this->app[Kernel::class]->setArtisan(null);

            RefreshDatabaseState::$migrated = true;
        }

        $this->beginDatabaseTransaction();
    }

    /**
     * Simplified version of dump. It displays arrays ready for use. Useful to build expected array for tests.
     * @param $var
     */
    public function dump($var)
    {
        $dumper = new CliDumper(
            null,
            null,
            AbstractDumper::DUMP_LIGHT_ARRAY + AbstractDumper::DUMP_TRAILING_COMMA
        );
        $cloner = new VarCloner();
        $dumper->setIndentPad('    ');
        $dumper->dump($cloner->cloneVar($var));
    }

    /**
     * Simplified version of dd. It displays arrays ready for use. Useful to build expected array for tests.
     * @param $var
     */
    public function dd($var)
    {
        $this->dump($var);
        die;
    }
}
