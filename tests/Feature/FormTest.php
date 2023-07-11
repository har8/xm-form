<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class FormTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testFormValidation()
    {
        $response = $this->post('/form', []);

        $response->assertStatus(302)
                 ->assertSessionHasErrors(['company_symbol', 'start_date', 'end_date', 'email']);
    }

}
