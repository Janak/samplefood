<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * The Production Unit record
 * @ORM\Table(name="production_unit",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="production_unit_name",
 *            columns={"name" })
 *    }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\ProductionUnitRepository")
 * @UniqueEntity(fields="name", message="This name already exists")
 * @ApiResource
 */
class ProductionUnit
{
    /**
     * @var int Id of production unit
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Name of production unit
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

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
}
