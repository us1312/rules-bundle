<?php

namespace SCA\Rules\Domain\Rule;

use SCA\Rules\Domain\Event\EventInterface;
use SCA\Rules\Repository\RuleRepository;

final readonly class RuleEngine {
    public function __construct(
        private RuleRegistry $registry,
        private RuleRepository $ruleRepository,
    ) {}

    public function handle(EventInterface $event): void {
        $rules = $this->ruleRepository->findBy(['event' => $event->getName()]);
        $context = $event->getContext();
        foreach ($rules as $rule) {
            $allMet = true;
            if ($rule->event !== $event->getName()) {
                continue;
            }

            foreach ($rule->getConditions() as $conditionName) {
                $condition = $this->registry->getCondition($conditionName);
                if (!$condition || !$condition->evaluate($context)) {
                    $allMet = false;
                    break;
                }
            }
            if (!$allMet) {
                continue;
            }

            foreach ($rule->getActions() as $actionName) {
                $action = $this->registry->getAction($actionName);
                if ($action) {
                    $params = $rule->getParameters()[$actionName] ?? [];
                    $action->execute([...$context, ...$params]);
                }
            }
        }
    }
}