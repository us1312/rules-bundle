<?php

namespace SCA\Rules\Domain\Condition;

abstract class AbstractCondition implements ConditionInterface {

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