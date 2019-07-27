<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    const STATUS_PENDING = 'P';
    const STATUS_COMPLETED = 'C';
    const STATUS_CANCELLED = 'Z';
    
    const ALL_STATUS_LABELS = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"project_show"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"project_show"})
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"project_show"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=1)
     * @Groups({"project_show"})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"project_show"})
     */
    private $createdDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"project_show"})
     */
    private $completionDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\Column(type="date")
     * @Groups({"project_show"})
     * @Assert\NotNull
     */
    private $dueDate;

    /**
     * @ORM\Column(type="json")
     */
    private $history = [];

    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->status = self::STATUS_PENDING;
        $this->createdDate = new \DateTime();
        $this->dueDate = new \DateTime('+4weeks');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @Groups({"project_show"})
     */
    public function getStatusLabel()
    {
        return self::ALL_STATUS_LABELS[$this->status];
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

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getCompletionDate(): ?\DateTimeInterface
    {
        return $this->completionDate;
    }

    public function setCompletionDate(?\DateTimeInterface $completionDate): self
    {
        $this->completionDate = $completionDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status, User $user = null): self
    {
        //drop out if no change
        if ($status === $this->status) {
            return $this;
        }

        if ($status === self::STATUS_PENDING) {
            $this->completionDate = null;
        } else {
            $this->completionDate = new \DateTime();
        }

        if ($user !== null) {
            $this->history[] = sprintf(
                'Status changed to "%s" by %s, %s',
                self::ALL_STATUS_LABELS[$status],
                $user->getDisplayName(),
                (new \DateTime())->format('d/m/Y H:i a')
            );
        }

        $this->status = $status;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTimeInterface $dueDate = null): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getHistory()
    {
        return $this->history;
    }
}
