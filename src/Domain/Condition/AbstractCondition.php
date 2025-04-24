<?php

namespace SCA\Rules\Domain\Condition;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractCondition implements ConditionInterface {

    public function __construct(protected readonly EntityManagerInterface $entityManager) {}

    protected function compare(mixed $a, mixed $b, string $operator): bool
    {
        return match ($operator) {
            '===' => $a === $b,
            '!==' => $a !== $b,
            '=='  => $a == $b,
            '!='  => $a != $b,
            '>'   => $a > $b,
            '>='  => $a >= $b,
            '<'   => $a < $b,
            '<='  => $a <= $b,
            default => throw new InvalidArgumentException("Unsupported operator: $operator"),
        };
    }
}