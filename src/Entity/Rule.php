<?php

namespace SCA\Rules\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'rule')]
class Rule
{
    #[Id]
    #[Column(type: UuidType::NAME, unique: true)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[Column(length: 255)]
    private string $name;

    #[Column(length: 255)]
    private string $event;

    #[Column(type: 'json')]
    private array $conditions;

    #[Column(type: 'json')]
    private array $actions;

    #[Column(type: 'json', nullable: true)]
    private array $parameters;

    #[Column]
    private int $weight;

    public function __construct(
        string $name = 'NoName',
        string $event,
        array $conditions,
        array $actions,
        array $parameters = [],
        int $weight = 0
    ) {
        $this->name = $name;
        $this->event = $event;
        $this->conditions = $conditions;
        $this->actions = $actions;
        $this->parameters = $parameters;
        $this->weight = $weight;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name = 'NoName'): void {
        $this->name = $name;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function setEvent(string $event): void {
        $this->event = $event;
    }

    public function getConditions(): array
    {
        return $this->conditions;
    }

    public function setConditions(array $conditions): void {
        $this->conditions = $conditions;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function setActions(array $actions): void {
        $this->actions = $actions;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): void {
        $this->parameters = $parameters;
    }

    public function setWeight(int $weight = 0): void {
        $this->weight = $weight;
    }

    public function getWeight(): int {
        return $this->weight;
    }
}