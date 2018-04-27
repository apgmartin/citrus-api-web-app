<?php

namespace Tests\Functional;


class CreateRouteTest extends BaseTestCase
{
    /**
     * Test that the /routes/new route returns a rendered response containing some expected text.
     */
    public function testGetRoutes()
    {
        $response = $this->runApp('GET', '/routes/new');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('You are creating a new route', (string)$response->getBody());
    }
}
