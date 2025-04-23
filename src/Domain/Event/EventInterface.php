<?php

namespace SCA\Rules\Domain\Event;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('rules.event')]
interface EventInterface {
    public function getName(): string;
    public function getLabel(): string;
    public function getContext(): array;
    public function setContext(array $data): void;
}