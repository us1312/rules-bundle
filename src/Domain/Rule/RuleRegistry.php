<?php

namespace SCA\Rules\Domain\Rule;

use SCA\Rules\Domain\Action\ActionInterface;
use SCA\Rules\Domain\Condition\ConditionInterface;
use SCA\Rules\Domain\Event\EventInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;
use SCA\Rules\Domain\Contract\ProvidesContext;
use SCA\Rules\Domain\Contract\RequiresContext;

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
    
    public function getAction(string $name): ?ActionInterface {
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
    
    public function getCondition(string $name): ?ConditionInterface {
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
    
    public function listEventsWithContext(): array {
        $out = [];
        foreach ($this->events as $e) {
            $out[] = [
                'name' => $e->getName(),
                'label' => $e->getLabel(),
                'providedContext' => $e instanceof ProvidesContext ? $e->getProvidedContextKeys() : [],
            ];
        }
        
        return $out;
    }
    
    public function listConditionsWithContext(): array {
        $out = [];
        foreach ($this->conditions as $c) {
            $out[] = [
                'name' => $c->getName(),
                'label' => $c->getLabel(),
                'requiredContext' => ($c instanceof RequiresContext) ? $c->getRequiredContextKeys() : [],
                'settings' => $c->getAllowedValues(),
            ];
        }
        
        return $out;
    }
    
    public function listActionsWithContext(): array {
        $out = [];
        foreach ($this->actions as $a) {
            $out[] = [
                'name' => $a->getName(),
                'label' => $a->getLabel(),
                'requiredContext' => ($a instanceof RequiresContext) ? $a->getRequiredContextKeys() : [],
                'allowedValues' => $a->getAllowedValues(),
            ];
        }
        
        return $out;
    }
}