<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Time unit
 *
 * @ORM\Table(name="time_unit",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="time_unit_name",
 *            columns={"name" })
 *    }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\TimeUnitRepository")
 * @UniqueEntity(fields="name", message="This name already exists")
 * @ApiResource
 */
class TimeUnit
{
    /**
     * @var int The Id of Time unit name
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name of time unit
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
