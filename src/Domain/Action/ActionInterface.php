<?php

namespace SCA\Rules\Domain\Action;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(ActionInterface::class)]
interface ActionInterface {

    public function getName(): string;
    public function getLabel(): string;
    public function getAllowedValues();
    public function execute(array $context): void;
}