<?php

namespace App\Repository;

use App\Entity\Group;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Group>
 *
 * @method Group|null find($id, $lockMode = null, $lockVersion = null)
 * @method Group|null findOneBy(array $criteria, array $orderBy = null)
 * @method Group[]    findAll()
 * @method Group[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Group::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.id', 'ASC')
            ->getQuery()
            ->getResult();
    }



    public function create(Group $group)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($group);
        $entityManager->flush();

        return $group;
    }

  

    public function update(Group $group)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->flush();

        return $group;
    }
}
