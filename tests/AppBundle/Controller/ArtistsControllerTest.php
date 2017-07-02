<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArtistsControllerTest extends WebTestCase
{
    private $artist = 'Skyfix';

    /**
     * @test
     */
    public function addNewArtist()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('app_artists_post');

        $client->request(
          'POST',
          $url,
          array(),
          array(),
          array('CONTENT_TYPE' => 'application/json'),
          json_encode(array('name' => $this->artist))
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->artist, $content->name);
    }

    /**
     * @test
     * @depends addNewArtist
     */
    public function searchSkyfixInArtists()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('app_artists_getall');
        $client->request('GET', $url);

        $response = $client->getResponse();
        $content = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));

        $skyfix = false;

        foreach ($content as $artist) {
          if ($artist->name == $this->artist) {
            $skyfix = true;
          }
        }

        $this->assertTrue($skyfix);
    }
}
