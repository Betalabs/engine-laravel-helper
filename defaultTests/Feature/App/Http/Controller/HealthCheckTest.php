<?php

namespace Tests\Feature\App\Http\Controller;


use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    public function testCheckShouldReturnOk()
    {
        $this->get('health-check')
            ->assertStatus(200);
    }
}
