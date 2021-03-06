<?php

namespace Tests\Functional;


class RoutesTest extends BaseTestCase
{
    /**
     * Test that the /routes route returns a rendered response containing some expected text.
     */
    public function testGetRoutes()
    {
        $response = $this->runApp('GET', '/routes');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Citrus-API: List Routes', (string)$response->getBody());
    }
}
