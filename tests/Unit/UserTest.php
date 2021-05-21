<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function only_logged_in_users_can_see_edit_pet_list()
    {
        $response = $this->get('/pet-personal')->assertRedirect('/login');
    }
}
