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
        return $this->events[$name] ?? null;
    }

    public function getCondition(string $name): ?ConditionInterface
    {
        return $this->conditions[$name] ?? null;
    }

    public function getAction(string $name): ?ActionInterface
    {
        return $this->actions[$name] ?? null;
    }
}