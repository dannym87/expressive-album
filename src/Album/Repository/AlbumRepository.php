<?php

namespace App\Album\Repository;

use App\Album\Entity\Album;
use Doctrine\DBAL\Connection;
use Zend\Hydrator\ArraySerializable;

class AlbumRepository implements AlbumRepositoryInterface
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        $qb = $this->db->createQueryBuilder();

        $qb
            ->select('*')
            ->from('album', 'a');

        $result = $qb->execute()->fetchAll();

        if (empty($result)) {
            return [];
        }

        $hydrator = new ArraySerializable();
        $albums = [];

        foreach ($result as $album) {
            array_push($albums, $hydrator->hydrate($album, new Album()));
        }

        return $albums;
    }

    /**
     * @param int $id
     * @return Album
     */
    public function fetchOne($id)
    {
        $qb = $this->db->createQueryBuilder();

        $qb
            ->select('*')
            ->from('album', 'a')
            ->where('id = :id')
            ->setParameter('id', $id);

        $result = $qb->execute()->fetch();

        if (!$result) {
            throw new \Exception("Could not find row $id");
        }

        return (new ArraySerializable())->hydrate($result, new Album());
    }

    /**
     * @param Album $album
     * @param int $id
     * @return int The number of affected rows
     */
    public function save(Album $album, $id = null)
    {
        $data = $album->getArrayCopy();

        if (null === $id) {
            return $this->db->insert('album', $data);
        } else {
            return $this->db->update('album', $data, [
                'id' => $id,
            ]);
        }
    }

    /**
     * @param Album $album
     * @return int
     */
    public function delete(Album $album)
    {
        return $this->db->delete('album', [
            'id' => $album->getId(),
        ]);
    }
}
