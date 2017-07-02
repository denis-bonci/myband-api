<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SongsControllerTest extends WebTestCase
{
    private $skyfix = 'Skyfix';
    private $title = 'Rock And Roll';

    private $songs = array(
        'Boston' => array('Peace of Mind'),
        'The Who' => array('Baba O\'Riley'),
        'Black Sabbath' => array('Paranoid'),
        'Led Zeppelin' => array('Whole Lotta Love', 'Rock And Roll'),
    );

    /**
     * @test
     */
    public function addNewProposal()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('app_songs_post');

        $client->request(
          'POST',
          $url,
          array(),
          array(),
          array('CONTENT_TYPE' => 'application/json'),
          json_encode(array(
            'title' => $this->title,
            'artist' => 5,
          ))
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->title, $content->title);
        $this->assertEquals($this->skyfix, $content->artist->name);
    }

    /**
     * @test
     * @depends addNewProposal
     */
    public function searchSkyfixSongInProposals()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('app_songs_getallproposals');
        $client->request('GET', $url);

        $response = $client->getResponse();
        $content = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));

        $proposal = $content[0];

        $this->assertEquals($proposal->title, $this->title);
        $this->assertEquals($proposal->artist->name, $this->skyfix);
      }

    /**
     * @test
     */
    public function searchSongs()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('app_songs_getall');
        $client->request('GET', $url);

        $response = $client->getResponse();
        $content = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));

        $songs = array();

        foreach ($content as $song) {
            $artist = $song->artist->name;
            if(isset($songs[$artist]))
            {
              $songs[$artist][] = $song->title;
            } else {
              $songs[$artist] = array($song->title);
            }
        }
        
        $this->assertArraySubset($songs, $this->songs);
    }
}
