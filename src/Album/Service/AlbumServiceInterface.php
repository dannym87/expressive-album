<?php

namespace App\Album\Service;

use App\Album\Entity\Album;

interface AlbumServiceInterface
{
    /**
     * List all the albums
     *
     * @return array
     */
    public function listAlbums();

    /**
     * Get a single album
     *
     * @param int $id
     * @return Album
     */
    public function getAlbum($id);

    /**
     * Add a new album
     *
     * @param array $data
     * @return bool
     */
    public function addAlbum(array $data);
}