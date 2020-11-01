<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testWelcome()
    {
        $response = $this->get(route('home'));
        $response->assertOk();
    }
}
