<?php

namespace SCA\Rules\Domain\Event;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('rules.event')]
interface EventInterface {
    public function getName(): string;
    public function getContext(): array;
}