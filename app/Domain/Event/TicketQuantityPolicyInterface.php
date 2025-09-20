<?php

declare(strict_types=1);

namespace App\Domain\Event;

interface TicketQuantityPolicyInterface
{
    public function canReserve(int $quantity): bool;
}
