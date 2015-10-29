<?php

namespace App\Album\Repository;

interface AlbumRepositoryInterface
{
    /**
     * @return array
     */
    public function fetchAll();
}