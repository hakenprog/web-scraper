<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A test to ensure that the homepage is displayed
     *
     * @return void
     */
    public function test_home_page_displayed()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
