<?php

namespace App\Entity\Contact;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Contact;

/**
 * @ORM\Table(name="contact_email")
 * @ORM\Entity(repositoryClass="App\Repository\Contact\EmailRepository")
 */
class Email
{
    const TYPE_PERSONAL = 'P';
    const TYPE_HOME = 'H';
    const TYPE_WORK = 'W';
    const TYPE_OTHER = 'O';
    
    const ALL_TYPE_LABELS = [
        self::TYPE_PERSONAL => 'Personal',
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact", inversedBy="emails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contact;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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
}
