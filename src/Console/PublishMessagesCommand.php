<?php

declare(strict_types=1);

namespace App\Console;

use App\Messenger\DoSomething;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class PublishMessagesCommand extends Command
{
    private const messagesCountArgument = 'messagesCount';

    protected static $defaultName = 'app:publish-messages';


    public function __construct(
        private MessageBusInterface $bus,
    ) {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this->addArgument(self::messagesCountArgument, InputArgument::REQUIRED, 'Amount of the messages');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $messagesCount = (int) $input->getArgument(self::messagesCountArgument);

        for ($i = 0; $i<= $messagesCount; $i++) {
            $randomNumber = random_int(1, 10);

            $this->bus->dispatch(new DoSomething($randomNumber));
        }

        return Command::SUCCESS;
    }
}
