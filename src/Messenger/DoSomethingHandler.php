<?php

declare(strict_types=1);

namespace App\Messenger;

use App\Messenger\Exception\PermanentFail;
use App\Messenger\Exception\TemporaryFail;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class DoSomethingHandler implements MessageHandlerInterface
{
    public function __invoke(DoSomething $message): void
    {
        if ($message->randomNumber === 1) {
            throw new TemporaryFail();
        }

        if ($message->randomNumber === 2) {
            throw new PermanentFail();
        }
    }
}
