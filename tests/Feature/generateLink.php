<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Pet;
use Carbon\Carbon;

class generateLink extends TestCase
{
    use RefreshDatabase;
    /**
     * Testing generate function
     *
     * @return void
     */
    public function testGenerate()
    {
        $url = 'http://studos.com.br';

        $response = Pet::generateCutedLink($url);

        $this->assertEquals(200, $response['status']);
    }

    /**
     * Testing checking duplication
     *
     * @return void
     */
    public function testGenerateDuplication()
    {
        $url = 'http://studos.com.br';

        //first register
        $response = Pet::generateCutedLink($url);

        $time_to_expire = Carbon::now()->addMinutes(5);
        $expire = date('Y-m-d H:i:s', strtotime($time_to_expire));

        //Regiter again
        $response = Pet::generateCutedLink($url);

        $this->assertEquals(200, $response['status']);
    }

    public function testInvalidUrl()
    {
        $url = 'soakoskaó;sakdi';
        $response = Pet::generateCutedLink($url);

        $this->assertEquals(400, $response['status']);
    }

}
