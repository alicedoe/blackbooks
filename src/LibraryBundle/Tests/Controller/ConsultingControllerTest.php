<?php

namespace LibraryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConsultingControllerTest extends WebTestCase
{
    public function testBooks()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/books');
    }

    public function testCategories()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/categories');
    }

}
