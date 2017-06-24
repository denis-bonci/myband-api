<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\CoverSong;
use AppBundle\Entity\CoverArtist;

class LoadArtistsAndSongsData implements FixtureInterface
{
    /**
     * Song's list.
     *
     * @var array
     */
    private $songs = array(
        'Boston' => array('Peace of Mind'),
        'The Who' => array('Baba O\'Riley'),
        'Black Sabbath' => array('Paranoid'),
        'Led Zeppelin' => array('Whole Lotta Love', 'Rock And Roll'),
    );

    public function load(ObjectManager $manager)
    {
        foreach ($this->songs as $artist_name => $songs) {
            $artist = new CoverArtist();
            $artist->setName($artist_name);
            $manager->persist($artist);

            foreach ($songs as $song_title) {
                $song = new CoverSong();
                $song->setTitle($song_title);
                $song->setArtist($artist);
                $song->setProposal(false);
                $manager->persist($song);
            }

            $manager->flush();
        }
    }
}
