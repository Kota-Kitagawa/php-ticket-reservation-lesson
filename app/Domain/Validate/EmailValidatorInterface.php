<?php

declare(strict_types=1);

namespace App\Domain\Validate;

interface EmailValidatorInterface
{
    public function validate(string $email): false|string;
}
