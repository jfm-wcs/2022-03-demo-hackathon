<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TodoItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TodoItemRepository::class)]
#[ApiResource(
    formats: ['json'],
    normalizationContext: ['groups' => 'getItems']
)]
class TodoItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['getLists', 'getItems'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['getLists', 'getItems'])]
    private $name;

    #[ORM\ManyToOne(targetEntity: TodoList::class, inversedBy: 'todoItems')]
    #[Groups(['getItems'])]
    private $todoList;

    public function getId(): ?int
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

    public function getTodoList(): ?TodoList
    {
        return $this->todoList;
    }

    public function setTodoList(?TodoList $todoList): self
    {
        $this->todoList = $todoList;

        return $this;
    }
}
