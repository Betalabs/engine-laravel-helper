<?php


namespace Betalabs\LaravelHelper\Helpers;


use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\AbstractDumper;
use Symfony\Component\VarDumper\Dumper\CliDumper;

class Dumper
{
    /**
     * Simplified version of dd. It displays arrays ready for use. Useful to build expected array for tests.
     * @param $var
     */
    public static function dd($var)
    {
        self::dump($var);
        die;
    }

    /**
     * Simplified version of dump. It displays arrays ready for use. Useful to build expected array for tests.
     * @param $var
     */
    public static function dump($var)
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
}