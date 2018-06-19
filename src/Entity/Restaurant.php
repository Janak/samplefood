<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The Restaurant record
 *
 * @ORM\Table(name="restaurant",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="restaurant_name",
 *            columns={"name" })
 *    }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantRepository")
 * @ApiResource
 */
class Restaurant
{
    /**
     * @var init The Id of Restaurant
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string name of restaurant
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var ProductionCapacity production capacity relation
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ProductionCapacity", mappedBy="Restaurant", orphanRemoval=true)
     */
    private $productionCapacities;

    public function __construct()
    {
        $this->productionCapacities = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString() {
        return $this->name;
    }

    /**
     * @return Collection|ProductionCapacity[]
     */
    public function getProductionCapacities(): Collection
    {
        return $this->productionCapacities;
    }

    public function addProductionCapacity(ProductionCapacity $productionCapacity): self
    {
        if (!$this->productionCapacities->contains($productionCapacity)) {
            $this->productionCapacities[] = $productionCapacity;
            $productionCapacity->setRestaurant($this);
        }

        return $this;
    }

    public function removeProductionCapacity(ProductionCapacity $productionCapacity): self
    {
        if ($this->productionCapacities->contains($productionCapacity)) {
            $this->productionCapacities->removeElement($productionCapacity);
            // set the owning side to null (unless already changed)
            if ($productionCapacity->getRestaurant() === $this) {
                $productionCapacity->setRestaurant(null);
            }
        }

        return $this;
    }
}
