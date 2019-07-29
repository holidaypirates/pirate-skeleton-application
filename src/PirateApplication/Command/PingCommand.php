<?php declare(strict_types=1);

namespace PirateApplication\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PingCommand extends Command
{
    public function configure()
    {
        $this
            ->setName('application:ping')
            ->setDescription(
                'Ahoy pirate, this is just a ping command that serves as an example to set you on sail'
            );
        parent::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('PONG');
    }
}
