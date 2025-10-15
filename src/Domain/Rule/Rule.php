<?php

namespace SCA\Rules\Domain\Rule;

final readonly class Rule {
    public function __construct(
        public string $name = 'NoName',
        public string $event = '',
        public array  $conditions = [],
        public array  $actions = [],
        public array  $parameters = [],
        public int    $weight = 0,
    ) {}
}