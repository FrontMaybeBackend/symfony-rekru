<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: TodoRepository::class)]
class Todo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'todo', targetEntity: TodoList::class)]
    private Collection $todolist;

    #[ORM\ManyToOne(inversedBy: 'todo')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->todolist = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
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

    public function addTodolist(TodoList $todolist): self
    {
        if (!$this->todolist->contains($todolist)) {
            $this->todolist->add($todolist);
            $todolist->setTodo($this);
        }

        return $this;
    }

    public function removeTodolist(TodoList $todolist): self
    {
        if ($this->todolist->removeElement($todolist)) {
            // set the owning side to null (unless already changed)
            if ($todolist->getTodo() === $this) {
                $todolist->setTodo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTodolist(): Collection
    {
        return $this->todolist;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('todoName', new NotBlank());

    }

}