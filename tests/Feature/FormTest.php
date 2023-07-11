<?php

namespace Tests\Feature;

use Tests\TestCase;

class FormTest extends TestCase
{

    //Testing Form submission missing parameters.
    public function testFormValidation()
    {
        $response = $this->post('/form', []);

        $response->assertStatus(302)
                 ->assertSessionHasErrors(['company_symbol', 'start_date', 'end_date', 'email']);
    }

    //Testing Form view
    public function testFormView()
    {

        $response = $this->get('/');
    
        $response->assertStatus(200)
                  ->assertViewIs('form')
                  ->assertSee('Company Symbol')
                  ->assertSee('Start Date')
                  ->assertSee('End Date')
                  ->assertSee('Email')
                  ->assertSee('Submit');
    }

}
