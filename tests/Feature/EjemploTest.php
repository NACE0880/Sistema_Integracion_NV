<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EjemploTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function test_crear_tickets()
    {
        $response = $this->get('/tickets/creacion');
        $response->assertStatus(200);
        $response->assertSee("Crear Ticket");
    }
}
