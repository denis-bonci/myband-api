<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * CoverArtist
 *
 * @ORM\Table(name="cover_artist")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoverArtistRepository")
 */
class CoverArtist
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"artists", "songs"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Groups({"artists", "songs"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="CoverSong", mappedBy="artist")
     */
    private $songs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->songs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CoverArtist
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add song
     *
     * @param \AppBundle\Entity\CoverSong $song
     *
     * @return CoverArtist
     */
    public function addSong(\AppBundle\Entity\CoverSong $song)
    {
        $this->songs[] = $song;

        return $this;
    }

    /**
     * Remove song
     *
     * @param \AppBundle\Entity\CoverSong $song
     */
    public function removeSong(\AppBundle\Entity\CoverSong $song)
    {
        $this->songs->removeElement($song);
    }

    /**
     * Get songs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSongs()
    {
        return $this->songs;
    }
}
