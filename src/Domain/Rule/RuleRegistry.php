<?php

namespace SCA\Rules\Domain\Rule;

use SCA\Rules\Domain\Action\ActionInterface;
use SCA\Rules\Domain\Condition\ConditionInterface;
use SCA\Rules\Domain\Event\EventInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class RuleRegistry {

    public function __construct(
        #[AutowireIterator(EventInterface::class)] private iterable $events,
        #[AutowireIterator(ConditionInterface::class)] private iterable $conditions,
        #[AutowireIterator(ActionInterface::class)] private iterable $actions,
    ) {}

    public function getEvent(string $name): ?EventInterface {
        foreach ($this->events as $event) {
            if ($event->getName() === $name) {
                return $event;
            }
        }

        return null;
    }

    public function getEvents(): iterable {
        return $this->events;
    }

    public function getAction(string $name): ?ActionInterface
    {
        foreach ($this->actions as $action) {
            if ($action->getName() === $name) {
                return $action;
            }
        }

        return null;
    }

    public function getActions(): iterable {
        return $this->actions;
    }

    public function getCondition(string $name): ?ConditionInterface
    {
        foreach ($this->conditions as $condition) {
            if ($condition->getName() === $name) {
                return $condition;
            }
        }

        return null;
    }

    public function getConditions(): iterable {
        return $this->conditions;
    }
}