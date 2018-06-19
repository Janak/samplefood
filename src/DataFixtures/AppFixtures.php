<?php
namespace App\DataFixtures;

use App\Entity\ProductGroup;
use App\Entity\ProductionCapacity;
use App\Entity\ProductionUnit;
use App\Entity\Restaurant;
use App\Entity\TimeUnit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 1; $i++) {
            $restaurant = new Restaurant();
            $restaurant->setName('R'.$i);
            $manager->persist($restaurant);
        }

        for ($i = 0; $i < 5; $i++) {
            $p = new ProductionUnit();
            $p->setName('production_unit_'.$i);
            $manager->persist($p);
        }

        for ($i = 0; $i < 3; $i++) {
            $t = new TimeUnit();
            $t->setName('time_unit'.$i);
            $manager->persist($t);
        }

        for ($i = 0; $i < 5; $i++) {
            $pg = new ProductGroup();
            $pg->setName('production_group_'.$i);
            $manager->persist($pg);
        }

        $manager->flush();

//        $pc = new ProductionCapacity();
  //      $pc->setRestaurant();


    }
}