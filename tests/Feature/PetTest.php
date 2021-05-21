<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class PetTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function testRegisterPet()
    {
        $response = $this->get('/pet-personal')->assertRedirect('/login');
        $response->assertStatus(500);
    }
}
