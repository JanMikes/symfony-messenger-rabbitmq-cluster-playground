<?php

declare(strict_types=1);

namespace App\Messenger;

use App\Entity\PersistentMessage;
use App\Messenger\Exception\PermanentFail;
use App\Messenger\Exception\TemporaryFail;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class DoSomethingHandler implements MessageHandlerInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger,
    ) {}


    public function __invoke(DoSomething $message): void
    {
        $this->logger->info('Consuming message seq: ' . $message->sequence);

        $randomNumber = random_int(1, 30);

        if ($randomNumber === 1) {
            throw new TemporaryFail('This is temporary fail - will be retried in few seconds. Seq: ' . $message->sequence);
        }

        if ($randomNumber === 2) {
            throw new PermanentFail('This is permanent fail - will be moved to failed queue directly. Seq: ' . $message->sequence);
        }

        $entity = new PersistentMessage($message->sequence);

        // Flush is done via messenger's middleware
        $this->entityManager->persist($entity);
    }
}
