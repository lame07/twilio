<?php

class HomeControllerTest extends TestCase
{

    public function testIndexPage()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testMissedParameterOnCallPage()
    {
        $crawler = $this->client->request('GET', '/callPage');

        $this->assertTrue($this->client->getResponse()->isRedirect());
    }

    public function testCallPage()
    {
        $crawler = $this->client->request('GET', '/callPage', ['country' => '12']);

        $this->assertTrue($this->client->getResponse()->isOk());
    }

}
