<?php

namespace App\Album\Service;

use App\Album\Entity\Album;
use App\Album\Form\AlbumForm;
use App\Album\Repository\AlbumRepositoryInterface;
use Zend\Hydrator\ArraySerializable;

class AlbumService implements AlbumServiceInterface
{
    /**
     * @var AlbumRepositoryInterface
     */
    protected $repository;

    /**
     * @var AlbumForm
     */
    protected $form;

    /**
     * @param AlbumRepositoryInterface $repository
     * @parm AlbumForm $form
     */
    public function __construct(AlbumRepositoryInterface $repository, AlbumForm $form)
    {
        $this->repository = $repository;
        $this->form = $form;
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

    /**
     * @param array $data
     * @return bool
     */
    public function addAlbum(array $data)
    {
        $this->form->setData($data);

        if ($this->form->isValid()) {
            $hydrator = new ArraySerializable();
            $album = $hydrator->hydrate($this->form->getData(), new Album());
            $album->setId(null);

            if (!$this->repository->save($album)) {
                throw new \Exception('Unable to save album');
            }

            return true;
        }

        return false;
    }

    /**
     * @param Album $album
     * @return bool
     */
    public function deleteAlbum(Album $album)
    {
        if (!$this->repository->delete($album)) {
            throw new \Exception(sprintf(
                'Unable to delete album "%s (%s)"', $album->getTitle(), $album->getArtist()
            ));
        }

        return true;
    }
}
