<?php

namespace App\Repository;

use DateTime;
use App\Entity\Job;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Job>
 *
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function save(Job $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Job $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    
//    /**
//     * @return Job[] Returns an array of Job objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }


public function search($criteria)
{
    $dateNow = new DateTime('now');
    $qb = $this->createQueryBuilder('r'); // SELECT * FROM Recipe r
   
    
        if(!empty($criteria['type'])) {
            $qb
                ->andWhere('r.type = :type') // WHERE (AND)
                ->setParameter('type', $criteria['type'])
            ;
        }
    
        if(!empty($criteria['department'])) {
            $qb
                ->andWhere('r.department = :department') // AND departement = :department
                ->setParameter('department', $criteria['department'])
            ;
        }
    
        $qb
           ->orderBy('r.sendAt', 'DESC')

           ->andWhere('r.endDate > :endDate')
           ->setParameter('endDate', $dateNow);
    
       return $qb->getQuery();
}


//    public function findOneBySomeField($value): ?Job
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
