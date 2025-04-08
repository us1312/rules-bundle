<?php

namespace SCA\Rules\Domain\Action;

use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('rules.action')]
interface ActionInterface {
    public function getName(): string;
    public function execute(array $context): void;
}