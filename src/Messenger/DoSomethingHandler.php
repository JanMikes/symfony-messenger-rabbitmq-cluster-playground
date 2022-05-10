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
        $randomNumber = random_int(1, 10);

        if ($randomNumber === 1) {
            throw new TemporaryFail('This is temporary fail - will be retried in few seconds. Seq: ' . $message->sequence);
        }

        if ($randomNumber === 2) {
            throw new PermanentFail('This is permanent fail - will be moved to failed queue directly. Seq: ' . $message->sequence);
        }
    }
}
