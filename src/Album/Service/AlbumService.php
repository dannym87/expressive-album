<?php

namespace App\Album\Service;

use App\Album\Entity\Album;
use App\Album\Repository\AlbumRepositoryInterface;

class AlbumService implements AlbumServiceInterface
{
    /**
     * @var AlbumRepositoryInterface
     */
    protected $repository;

    /**
     * @param AlbumRepositoryInterface $repository
     */
    public function __construct(AlbumRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function listAlbums()
    {
        return $this->repository->fetchAll();
    }

    /**
     * @param int $id
     * @return Album
     */
    public function getAlbum($id)
    {
        return $this->repository->fetchOne($id);
    }
}
