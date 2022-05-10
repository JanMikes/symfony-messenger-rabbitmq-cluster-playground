<?php

declare(strict_types=1);

namespace App\Messenger\Exception;

// If desired to force retry even if max retries, use RecoverableMessageHandlingException
final class TemporaryFail extends \RuntimeException
{

}
