<?php
namespace App\Tests\Repository;

use App\Repository\ProductionCapacityRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductionCapacityRepositoryTest extends KernelTestCase
{
    public function testValidateCollection()
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();

        $sample_1 = <<<EOT
         {
          "productionCapacities1": [
            {
              "amount": 10,
              "restaurant_id": 1,
              "productionUnit": {
                "id": 3,
                "name": "portion"
              },
              "timeUnit": {
                "id": 1,
                "name": "daily"
              },
              "productGroup": {
                "id": 56,
                "name": "sushi"
              }
            },
            {
              "amount": 500,
              "restaurant_id": 1,
              "productionUnit": {
                "id": 5,
                "name": "piece"
              },
              "timeUnit": {
                "id": 2,
                "name": "weekly"
              },
              "productGroup": {
                "id": 67,
                "name": "sandwich"
              }
            }
          ]
        }
EOT;

        $this->production_capacity = static::$kernel
            ->getContainer()
            ->get('App\Repository\ProductionCapacityRepository');

        $json_data = json_decode($sample_1, true);
        $error = $this->production_capacity->validateCollection($json_data);
        $this->assertEquals('Wrong Data', $error[0]);
    }
}