<?php

namespace SCA\Rules\Domain\Action;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractAction implements ActionInterface {
    public function __construct(protected readonly EntityManagerInterface $entityManager) {}
}