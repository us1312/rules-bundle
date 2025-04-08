<?php

namespace SCA\Rules\Domain\Rule;

final readonly class Rule {
    public function __construct(
        public string $event,
        public array  $conditions,
        public array  $actions,
        public array  $parameters = [],
    ) {}
}