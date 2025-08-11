<?php

namespace SCA\Rules\Domain\Contract;

interface RequiresContext { public function getRequiredContextKeys(): array; }