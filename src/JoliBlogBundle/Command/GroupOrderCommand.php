<?php

namespace JoliBlogBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class GroupOrderCommand extends Command
{
    protected function configure()
    {
        $this->setName('iesa:group-order');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Ordre de passage des groupes',
            '============================',
            '',
        ]);

        $groups = [
            'Volombio',
            'Flemme de faire ma liste.com',
            'Project GEAR',
            'Daysounds',
            'Top Game',
            'Faimfony',
        ];

        shuffle($groups);

        foreach ($groups as $i => $group) {
            $line = 'Groupe ' . ($i + 1) . ' : ' . $group . "\n";
            $output->write($line);
            $process = new Process('say "' . $line . '"');
            $process->run();
        }
    }
}
