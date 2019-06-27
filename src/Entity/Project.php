<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"index"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"index"})
     * @Assert\NotBlank(message="Required field")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"index"})
     * @Assert\NotBlank(message="Required field")
     */
    private $property;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"index"})
     * @Assert\NotBlank(message="Required field")
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"index"})
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProperty(): ?string
    {
        return $this->property;
    }

    public function setProperty(string $property): self
    {
        $this->property = $property;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
