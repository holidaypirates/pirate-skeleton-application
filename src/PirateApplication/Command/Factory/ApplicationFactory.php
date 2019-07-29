<?php declare(strict_types=1);

namespace PirateApplication\Command\Factory;

use PirateApplication\Command\PingCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

class ApplicationFactory
{
    public function __invoke(ContainerInterface $container): Application
    {
        $app = new Application($this->getApplicationName());

        $app->addCommands([
            $container->get(PingCommand::class)
        ]);

        return $app;
    }

    private function getApplicationName()
    {
        return <<<STRING

    Pirate Application Command Line Tool

                 _.--""""''-.
              .-'            '.
            .'                 '.
           /            .        )
          |                   _  (
          |          .       / \  \
          \         .     .  \_/  |
           \    .--' .  '         /
            \  /  .'____ _       /,
             '/   (\    `)\       |
             ||\__||    |;-.-.-,-,|
             \\___//|   \--'-'-'-'|
              '---' \             |
       .--.          '---------.__)   .-.
      .'   \                         /  '.
     (      '.                    _.'     )
      '---.   '.              _.-'    .--'
           `.   `-._      _.-'   _.-'`
             `-._   '-.,-'   _.-'
                 `-._   `'.-'
               _.-'` `;.   '-._
        .--.-'`  _.-'`  `'-._  `'-.--.
       (       .'            '.       )
        `,  _.'                '._  ,'
          ``                      ``
STRING;
    }
}
