<?php

namespace SCA\Rules\Domain\Rule;

use Doctrine\ORM\EntityManagerInterface;
use SCA\Rules\Domain\Event\EventInterface;
use SCA\Rules\Repository\RuleRepository;
use SCA\Rules\Entity\Rule;

final readonly class RuleEngine {

    public function __construct(
        private RuleRegistry $registry,
        private EntityManagerInterface $em,
    ) {}

    public function handle(EventInterface $event): void {
        $rulesRepo = $this->em->getRepository(Rule::class);
        $rules = $rulesRepo->findBy(['event' => $event->getName()], ['weight' => 'ASC']);
        $context = $event->getContext();
        foreach ($rules as $rule) {
            $allMet = true;
            if ($rule->getEvent() !== $event->getName()) {
                continue;
            }
            foreach ($rule->getConditions() as $condition) {
                $conditionObject = $this->registry->getCondition($condition['name']);
                if (!$conditionObject || !$conditionObject->evaluate([...$context, ...$rule->getParameters(), 'conditionValue' => $condition])) {
                    $allMet = false;
                    break;
                }
            }
            if (!$allMet) {
                continue;
            }

            foreach ($rule->getActions() as $action) {
                $actionObject = $this->registry->getAction($action['name']);
                if ($action) {
                    $actionObject->execute([...$context, ...$rule->getParameters(), 'actionValue' => $action]);
                }
            }
        }
    }

    public function getEventByName(string $name): ?EventInterface {
        return $this->registry->getEvent($name);
    }

    public function getEvents() {
        return $this->registry->getEvents();
    }

    public function getConditions() {
        return $this->registry->getConditions();
    }

    public function getActions() {
        return $this->registry->getActions();
    }


}