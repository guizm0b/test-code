<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PodcastRepository")
 */
class Podcast
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=100)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 5, max = 100)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="text")
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 5, max = 255)
     */
    private $description;

    /**
     * @ORM\Column(name="episode_number", type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     */
    private $episodeNumber;

    /**
     * @ORM\Column(name="publish_date", type="datetime")
     *
     * @Assert\DateTime()
     */
    private $publishDate;

    /**
     * @ORM\Column(name="filename", type="string", length=100)
     *
     * @Assert\NotBlank()
     */
    private $filename;

    public function __construct()
    {
        $this->publishDate = new \Datetime('now');
    }

    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param int id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @param string title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param string description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of Episode Number
     *
     * @return int
     */
    public function getEpisodeNumber()
    {
        return $this->episodeNumber;
    }

    /**
     * Set the value of Episode Number
     *
     * @param int episodeNumber
     *
     * @return self
     */
    public function setEpisodeNumber($episodeNumber)
    {
        $this->episodeNumber = $episodeNumber;

        return $this;
    }

    /**
     * Get the value of Publish Date
     *
     * @return \Datetime
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Set the value of Publish Date
     *
     * @param \Datetime publishDate
     *
     * @return self
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get the value of Filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of Filename
     *
     * @param string filename
     *
     * @return self
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }
}
