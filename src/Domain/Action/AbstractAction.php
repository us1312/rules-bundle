<?php

namespace SCA\Rules\Domain\Action;

use Doctrine\ORM\EntityManagerInterface;
use SCA\Rules\Domain\Contract\RequiresContext;

abstract class AbstractAction implements ActionInterface, RequiresContext {
    
    public function __construct(protected readonly EntityManagerInterface $entityManager) {}
}