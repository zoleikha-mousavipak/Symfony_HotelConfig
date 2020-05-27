<?php

namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetAverage()
    {
        $client = static::createClient();

        $client->request('GET', '/api/average?hotelId=1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('6.25', $client->getResponse()->getContent());

        $client->request('GET', '/api/average?hotelId=2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('7.5', $client->getResponse()->getContent());
    }

    public function testGetReviews()
    {
        $client = static::createClient();

        $client->request('GET', '/api/reviews?hotelId=1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":"1","hotel_id":"1","score":"10","comment":"Very nice stay"},{"id":"2","hotel_id":"1","score":"5","comment":"Average"},{"id":"3","hotel_id":"1","score":"9","comment":"Very nice stay, I enjoyed it a lot."},{"id":"4","hotel_id":"1","score":"1","comment":"Worst experience ever."}]', $client->getResponse()->getContent());

        $client->request('GET', '/api/reviews?hotelId=2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":"5","hotel_id":"2","score":"5","comment":"The receptionist was not smiling."},{"id":"6","hotel_id":"2","score":"10","comment":"Very nice stay, the reception was really fast."}]', $client->getResponse()->getContent());
    }

    public function testGetHotels()
    {
        $client = static::createClient();

        $client->request('GET', '/api/hotels');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":"1","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"},{"id":"2","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"},{"id":"3","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"},{"id":"4","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"},{"id":"5","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"}]', $client->getResponse()->getContent());
    }
}
