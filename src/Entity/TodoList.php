<?php

namespace App\Entity;

use App\Repository\TodoListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoListRepository::class)]
class TodoList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?string $task = null;


    #[ORM\ManyToOne(inversedBy: 'todolist')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'todolist')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Todo $todo = null;


    /**
     * @return mixed
     */

    /**
     * @return string|null
     */
    public function getTask(): ?string
    {
        return $this->task;
    }

    /**
     * @param string|null $task
     */
    public function setTask(?string $task): void
    {
        $this->task = $task;
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

    /**
     * @param Todo|null $todo
     */
    public function setTodo(?Todo $todo): void
    {
        $this->todo = $todo;
    }

    /**
     * @return Todo|null
     */
    public function getTodo(): ?Todo
    {
        return $this->todo;
    }
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
