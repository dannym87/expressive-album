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
        return $this->save($data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function updateAlbum(array $data, $id)
    {
        return $this->save($data, $id);
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

    /**
     * @param array $data
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    protected function save(array $data, $id = null)
    {
        $this->form->setData($data);

        if (!$this->form->isValid()) {
            throw new \Exception('Form failed to validate. Unable to save album');
        }

        /**
         * @var Album $album
         */
        $album = $this->form->getData();

        $this->repository->save($album, $id);

        return true;
    }
}
