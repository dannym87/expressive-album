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
}