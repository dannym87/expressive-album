<?php

namespace App\Album\Repository;

use App\Album\Entity\Album;

interface AlbumRepositoryInterface
{
    /**
     * @return array
     */
    public function fetchAll();

    /**
     * @param int $id
     * @return Album
     */
    public function fetchOne($id);

    /**
     * @param Album $album
     * @return bool
     */
    public function save(Album $album);

    /**
     * @param Album $album
     * @return bool
     */
    public function delete(Album $album);
}