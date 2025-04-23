<?php

namespace SCA\Rules\Domain\Condition;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('rules.condition')]
interface ConditionInterface {
    public function getName(): string;
    public function evaluate(array $context): bool;
}