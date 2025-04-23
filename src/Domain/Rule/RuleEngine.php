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
        $rules = $rulesRepo->findBy(['event' => $event->getName()]);
        $context = $event->getContext();
        foreach ($rules as $rule) {
            $allMet = true;
            if ($rule->getEvent() !== $event->getName()) {
                continue;
            }
            foreach ($rule->getConditions() as $conditionName => $conditionValue) {
                $condition = $this->registry->getCondition($conditionName);
                if (!$condition || !$condition->evaluate([...$context, ...$rule->getParameters(), 'conditionValue' => $conditionValue])) {
                    $allMet = false;
                    break;
                }
            }
            if (!$allMet) {
                continue;
            }

            foreach ($rule->getActions() as $actionName => $actionValue) {
                $action = $this->registry->getAction($actionName);
                if ($action) {
                    $action->execute([...$context, ...$rule->getParameters(), 'actionValue' => $actionValue]);
                }
            }
        }
    }
    
    public function getEventByName(string $name): ?EventInterface
    {
        return $this->registry->getEvent($name);
    }
}