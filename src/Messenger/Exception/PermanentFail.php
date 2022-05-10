<?php

declare(strict_types=1);

namespace App\Messenger\Exception;

use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;

// https://symfony.com/doc/current/messenger.html#avoiding-retrying
final class PermanentFail extends UnrecoverableMessageHandlingException
{
}
