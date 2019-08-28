<?php


namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Services\App\ExtraField\ExtraFieldFormFinder;

class ExtraFieldFormFinderTest extends TestCase
{
    public function testFindByLabel()
    {
        $form = (object)[
            "extra_fields" => [
                (object)[
                    "id" => 7,
                    "label" => "CNPJ",
                    "slug" => "cnpj",
                    "extra_field_type" => (object)[
                        "id" => 1,
                        "name" => "Texto",
                        "type" => "text",
                        "multiple" => false
                    ]
                ]
            ]
        ];

        $label = 'CNPJ';
        $finder = resolve(ExtraFieldFormFinder::class);
        $extraField = $finder->findByLabel($form, $label);

        $this->assertEquals(7, $extraField->id);
    }
}