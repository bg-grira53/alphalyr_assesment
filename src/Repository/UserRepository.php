<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }



    public function findAll(): array
    {
        return $this->createQueryBuilder('u')
        ->orderBy('u.id', 'ASC')
        ->getQuery()
        ->getResult();
    }

    public function create(User $user)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $user;
    }

    public function findOne(int $id)
    {
        return $this->find($id);
    }

    public function update(User $user)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->flush();

        return $user;
    }

 

}
