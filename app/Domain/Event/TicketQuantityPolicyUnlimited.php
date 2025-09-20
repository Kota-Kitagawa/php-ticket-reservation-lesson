<?php

declare(strict_types=1);

namespace App\Domain\Event;

class TicketQuantityPolicyUnlimited implements TicketQuantityPolicyInterface
{
    // 予測可能なチケットの枚数化
    public function canReserve(int $quantity): bool
    {
        // 無制限
        return true;
    }
}
