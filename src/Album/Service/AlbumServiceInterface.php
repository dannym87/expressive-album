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

    /**
     * Update an existing album
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function updateAlbum(array $data, $id);

    /**
     * Delete an album
     *
     * @param Album $album
     * @return bool
     */
    public function deleteAlbum(Album $album);
}