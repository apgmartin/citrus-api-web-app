<?php

namespace Tests\Functional;


class ViewRouteTest extends BaseTestCase
{
    private $ROUTE_ID = 12345;

    /**
     * Test that the /routes/{id} route returns a rendered response containing some expected text with route id.
     */
    public function testGetRoutes()
    {
        $response = $this->runApp('GET', '/routes/' . $this->ROUTE_ID);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('This is the route with id ' . $this->ROUTE_ID, (string)$response->getBody());
    }
}
