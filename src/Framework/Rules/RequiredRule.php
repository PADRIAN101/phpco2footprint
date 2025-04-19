<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class RequiredRule implements RuleInterface
{
    #handling validation logic for single field
    public function validate(array $data, string $field, array $params): bool
    {
        return !empty($data[$field]);
    }

    #if error, prompt a message
    public function getMessage(array $data, string $field, array $params): string
    {
        return "This field is required.";
    }
}
