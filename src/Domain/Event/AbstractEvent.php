<?php

namespace SCA\Rules\Domain\Event;

use SCA\Rules\Domain\Contract\ProvidesContext;

abstract class AbstractEvent implements EventInterface, ProvidesContext {
    
    protected array $context = [];
    
    public function getContext(): array {
        return $this->context;
    }
    
    public function setContext(array $data): void {
        $this->context = $data;
    }
}