<?php

namespace App\Repository;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\ProductionCapacity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Product capacity service
 *
 * @method ProductionCapacity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionCapacity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionCapacity[]    findAll()
 * @method ProductionCapacity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionCapacityRepository extends ServiceEntityRepository
{
    private $product_unit;

    private $time_unit;

    private $product_group;

    private $restaurant;

    private $validator;

    private $entityManager;

    /**
     * ProductionCapacityRepository constructor.
     *
     * @param RegistryInterface $registry
     * @param ProductionUnitRepository $productionUnitRepository
     * @param TimeUnitRepository $timeUnitRepository
     * @param ProductGroupRepository $productGroupRepository
     */
    public function __construct(RegistryInterface $registry, ProductionUnitRepository $productionUnitRepository, TimeUnitRepository $timeUnitRepository, ProductGroupRepository $productGroupRepository, RestaurantRepository $restaurantRepository, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
       parent::__construct($registry, ProductionCapacity::class);

        $this->product_group = $productGroupRepository;
        $this->time_unit = $timeUnitRepository;
        $this->product_unit = $productionUnitRepository;
        $this->restaurant = $restaurantRepository;
        $this->validator = $validator;
        $this->entityManager = $entityManager;

    }

    /**
     * Validate collection data
     *
     * @param $data
     * @return array
     */
    public function validateCollection($data)
    {
        $errors = [];

        if (isset($data['productionCapacities'])) {

            foreach ($data['productionCapacities'] as $item) {

                if (isset($item['amount']) && isset($item['productionUnit']['id']) && isset($item['timeUnit']['id']) &&  isset($item['productGroup']['id']) && isset($item['restaurant_id'])) {

                    $capacity = new ProductionCapacity();

                    $capacity->setAmount($item['amount']);

                    $productionUnit = $this->product_unit->find($item['productionUnit']['id']);
                    $capacity->setProductionUnit($productionUnit);

                    $timeUnit = $this->time_unit->find($item['timeUnit']['id']);
                    $capacity->setTimeUnit($timeUnit);

                    $productGroup = $this->product_group->find($item['productGroup']['id']);
                    $capacity->setProductGroup($productGroup);

                    $restaurant = $this->product_group->find($item['restaurant_id']);
                    $capacity->setRestaurant($restaurant);

                    $errors[] = $this->validator->validate($capacity);
                } else {
                    $errors[] = 'Wrong Data';
                }
            }
        } else {
            $errors[] = 'Wrong Data';
        }

        return $errors;
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
        try {

            foreach ($data['productionCapacities'] as $item) {
                $pc = new ProductionCapacity();
                $pc->setAmount();
            }

        } catch (\Exception $e) {


        }
    }
}
