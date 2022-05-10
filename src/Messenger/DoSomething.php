<?php

declare(strict_types=1);

namespace App\Messenger;

final class DoSomething
{
    public function __construct(
        public readonly int $sequence,
    ) {}
}
