<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface RuleInterface
{

    #handling validation logic for single field
    public function validate(array $data, string $field, array $params): bool;

    #if error, prompt a message
    public function getMessage(array $data, string $field, array $params): string;
}
