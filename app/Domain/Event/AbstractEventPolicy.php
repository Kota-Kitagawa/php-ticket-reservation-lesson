<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\Validate\EmailValidatorInterface;

abstract class AbstractEventPolicy implements EventPolicyInterface
{
    public function __construct(
        private TicketQuantityPolicyInterface $ticketQuantityPolicy,
        private EmailValidatorInterface $emailValidator,
    ) {
    }

    public function canReserveQuantity(int $quantity): bool
    {
        return $this->ticketQuantityPolicy->canReserve($quantity);
    }

    // emailアドレスのvalidate
    public function emailValidate(string $email): string | false
    {
        return $this -> emailValidator -> validate($email);
    }
}
