<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Production capacity
 *
 * @ORM\Table(name="production_capacity",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="capacity_unique",
 *            columns={"restaurant_id", "time_unit_id", "product_group_id", "production_unit_id"})
 *    }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProductionCapacityRepository")
 * @ApiResource(itemOperations={
 *     "get",
 *     "product_capacity_bulk_post" = {"route_name" = "product_capacity_bulk"}
 *     })
 */
class ProductionCapacity
{
    /**
     * @var int The Id of production capacity record
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int production capacity amount
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $amount;

    /**
     * @var Restaurant
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Restaurant", inversedBy="productionCapacities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Restaurant;

    /**
     * @var TimeUnit
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TimeUnit", inversedBy="productionCapacities")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource
     */
    private $TimeUnit;

    /**
     * @var ProductGroup
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductGroup", inversedBy="productionCapacities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ProductGroup;

    /**
     * @var ProductionUnit
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductionUnit", inversedBy="productionCapacities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ProductionUnit;


    public function getId()
    {
        return $this->id;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->Restaurant;
    }

    public function setRestaurant(?Restaurant $Restaurant): self
    {
        $this->Restaurant = $Restaurant;

        return $this;
    }

    public function getTimeUnit(): ?TimeUnit
    {
        return $this->TimeUnit;
    }

    public function setTimeUnit(?TimeUnit $TimeUnit): self
    {
        $this->TimeUnit = $TimeUnit;

        return $this;
    }

    public function getProductGroup(): ?ProductGroup
    {
        return $this->ProductGroup;
    }

    public function setProductGroup(?ProductGroup $ProductGroup): self
    {
        $this->ProductGroup = $ProductGroup;

        return $this;
    }

    public function getProductionUnit(): ?ProductionUnit
    {
        return $this->ProductionUnit;
    }

    public function setProductionUnit(?ProductionUnit $ProductionUnit): self
    {
        $this->ProductionUnit = $ProductionUnit;

        return $this;
    }
}
