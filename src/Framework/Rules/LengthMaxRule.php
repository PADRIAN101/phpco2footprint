<?php

namespace Framework\Rules;

use Dotenv\Exception\InvalidFileException;
use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

#To create length limit validation rule
class LengthMaxRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    if (empty($params[0])) {
      throw new InvalidFileException('Maximum length not specified');
    }

    $length = (int) $params[0];

    return strlen($data[$field]) < $length;
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Exceeds maximum character limit of {$params[0]} characters.";
  }
}
