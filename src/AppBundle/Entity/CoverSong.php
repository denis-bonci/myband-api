<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * CoverSong
 *
 * @ORM\Table(name="cover_song")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoverSongRepository")
 */
class CoverSong
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"songs"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Groups({"songs"})
     */
    private $title;

    /**
     * @var bool
     *
     * @ORM\Column(name="proposal", type="boolean", nullable=true)
     */
    private $proposal = true;

    /**
     * @ORM\ManyToOne(targetEntity="CoverArtist", inversedBy="songs")
     * @Groups({"songs"})
     */
    private $artist;

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
     * Set title
     *
     * @param string $title
     *
     * @return CoverSong
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set artist
     *
     * @param \AppBundle\Entity\CoverArtist $artist
     *
     * @return CoverSong
     */
    public function setArtist(\AppBundle\Entity\CoverArtist $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \AppBundle\Entity\CoverArtist
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set proposal
     *
     * @param boolean $proposal
     *
     * @return CoverSong
     */
    public function setProposal($proposal)
    {
        $this->proposal = $proposal;

        return $this;
    }

    /**
     * Get proposal
     *
     * @return boolean
     */
    public function getProposal()
    {
        return $this->proposal;
    }
}
