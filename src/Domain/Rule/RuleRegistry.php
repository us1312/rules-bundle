<?php

namespace SCA\Rules\Domain\Rule;

use SCA\Rules\Domain\Action\ActionInterface;
use SCA\Rules\Domain\Condition\ConditionInterface;
use SCA\Rules\Domain\Event\EventInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class RuleRegistry {

    public function __construct(
        #[AutowireIterator('rules.action')] private iterable $actions,
        #[AutowireIterator('rules.event')] private iterable $events,
        #[AutowireIterator('rules.condition')] private iterable $conditions,
    ) {}

    public function getEvent(string $name): ?EventInterface
    {
        foreach ($this->events as $event) {
            if ($event->getName() === $name) {
                return $event;
            }
        }

        return null;
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

    public function getAction(string $name): ?ActionInterface
    {
        foreach ($this->actions as $action) {
            if ($action->getName() === $name) {
                return $action;
            }
        }

        return null;
    }
}