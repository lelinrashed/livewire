<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;


    function can_register()
    {
        Livewire::test('auth.register')
        ->set('email', 'lelinrashed')
        ->set( 'name', 'lelinrashed')
        ->set('password', 'secret')
        ->set('passwordConfirmation', 'secret')
        ->call('register')
        ->assertRedirect('/');
    }
}
