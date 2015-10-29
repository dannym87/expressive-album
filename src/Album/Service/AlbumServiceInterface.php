<?php

namespace App\Album\Service;

interface AlbumServiceInterface
{
    /**
     * List all the albums
     *
     * @return array
     */
    public function listAlbums();
}