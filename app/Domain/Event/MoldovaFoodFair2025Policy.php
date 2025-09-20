<?php

declare(strict_types=1);

namespace App\Domain\Event;

class MoldovaFoodFair2025Policy extends AbstractEventPolicy
{
    public function eventTitle(): string
    {
        return '2025年モルドバ料理フェア';
    }

}
