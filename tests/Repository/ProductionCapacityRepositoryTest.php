<?php
namespace App\Tests\Repository;

use App\Repository\ProductionCapacityRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductionCapacityRepositoryTest extends KernelTestCase
{

    public function testAdd()
    {
        self::bootKernel();

        // returns the real and unchanged service container
        $container = self::$kernel->getContainer();

        $this->production_capacity = static::$kernel
            ->getContainer()
            ->get('App\Repository\ProductionCapacityRepository');


        $data = $this->production_capacity->find(1);
        var_dump($data);
        //$this->assertEquals(42, 42);
    }
}