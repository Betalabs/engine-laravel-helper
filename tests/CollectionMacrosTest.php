<?php


namespace Betalabs\LaravelHelper\Tests;

use Illuminate\Support\Collection;

class CollectionMacrosTest extends TestCase
{
    public function testPipeEach()
    {
        $number = collect([1,2])->pipeEach([
            function ($i) {
                return $i + 1;
            },
            function ($i) {
                return $i * 3;
            }
        ]);

        $this->assertInstanceOf(Collection::class, $number);
        $this->assertEquals(6, $number[0]);
        $this->assertEquals(9, $number[1]);
    }

    public function testPipeEachWithExceptionHandling()
    {
        $number = collect([1,2])->pipeEach([
            function ($i) {
                return $i + 1;
            },
            function ($i) {
                throw new \Exception('test');
            }
        ], function ($exception, $originalElement) {
            $this->assertEquals('test', $exception->getMessage());
            $this->assertTrue($originalElement == 1 || $originalElement == 2);
        });

        $this->assertInstanceOf(Collection::class, $number);
        $this->assertEquals(2, $number[0]);
        $this->assertEquals(3, $number[1]);
    }

    public function testFirstOrReturnFirst()
    {
        $response = collect([1,2])->firstOr(function () {
            throw new \Exception();
        });

        $response = $this->assertEquals(1, $response);
    }

    public function testFirstOrHandlesException()
    {
        $response = collect()->firstOr(function () {
            return 10;
        });

        $response = $this->assertEquals(10, $response);
    }
}