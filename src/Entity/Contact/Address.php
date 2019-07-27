<?php

namespace App\Entity\Contact;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Contact;

/**
 * @ORM\Table(name="contact_address")
 * @ORM\Entity(repositoryClass="App\Repository\Contact\AddressRepository")
 */
class Address
{
    const TYPE_HOME = 'H';
    const TYPE_WORK = 'W';
    const TYPE_OTHER = 'O';
    
    const ALL_TYPE_LABELS = [
        self::TYPE_HOME => 'Home',
        self::TYPE_WORK => 'Work',
        self::TYPE_OTHER => 'Other',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact", inversedBy="addresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address2;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address3;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address4;

    /**
     * //Groups({"contact_"})
     */
    public function getTypeLabel()
    {
        return self::ALL_TYPE_LABELS[$this->type];
    }

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

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getAddress3(): ?string
    {
        return $this->address3;
    }

    public function setAddress3(?string $address3): self
    {
        $this->address3 = $address3;

        return $this;
    }

    public function getAddress4(): ?string
    {
        return $this->address4;
    }

    public function setAddress4(?string $address4): self
    {
        $this->address4 = $address4;

        return $this;
    }
}
