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

        $hydrator = new \Zend\Stdlib\Hydrator\ArraySerializable();
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
}