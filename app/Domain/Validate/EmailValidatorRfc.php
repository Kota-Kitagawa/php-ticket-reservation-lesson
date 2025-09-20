<?php

declare(strict_types=1);

namespace App\Domain\Validate;

class EmailValidatorRfc implements EmailValidatorInterface
{
    public function validate(string $email): string | false
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
