<?php

namespace App\Repository;

use App\Entity\ProductionCapacity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductionCapacity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionCapacity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionCapacity[]    findAll()
 * @method ProductionCapacity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionCapacityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductionCapacity::class);
    }

    /**
     * Save bulk data
     *
     * @param $data array
     *
     * @return string
     *
     */
    public function saveBulkData($data)
    {
        print_r($data);exit;
        try {

            foreach ($data as $item) {
                $pc = new ProductionCapacity();
                $pc->setAmount();
            }

        } catch (\Exception $e) {


        }
    }

//    /**
//     * @return ProductionCapacity[] Returns an array of ProductionCapacity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductionCapacity
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
