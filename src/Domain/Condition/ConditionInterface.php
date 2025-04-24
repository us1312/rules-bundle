<?php

namespace SCA\Rules\Domain\Condition;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(ConditionInterface::class)]
interface ConditionInterface {
    public function getAllowedValues(): array;
    public function getLabel(): string;
    public function getName(): string;
    public function evaluate(array $context): bool;
}