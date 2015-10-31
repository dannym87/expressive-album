<?php

namespace App\Album\Entity;

use Zend\Stdlib\ArraySerializableInterface;

class Album implements ArraySerializableInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $artist;

    /**
     * @var string
     */
    protected $title;

    public function __construct(array $data = null)
    {
        if (null !== $data) {
            $this->exchangeArray($data);
        }
    }

    /**
     * @return void
     */
    public function exchangeArray(array $array)
    {
        $this->id = $array['id'];
        $this->artist = $array['artist'];
        $this->title = $array['title'];
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id'     => $this->id,
            'artist' => $this->artist,
            'title'  => $this->title,
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Album
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param string $artist
     * @return Album
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Album
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

}