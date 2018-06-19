<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Product Group
 *
 * @ORM\Table(name="production_group",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="production_group_name",
 *            columns={"name" })
 *    }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\ProductGroupRepository")
 * @UniqueEntity(fields="name", message="This tag name already exists")
 * @ApiResource
 */
class ProductGroup
{
    /**
     * @var int The Id of product group
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string product group name
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
