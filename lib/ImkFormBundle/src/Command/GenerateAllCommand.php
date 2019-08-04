<?php

namespace Imk\FormBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class GenerateAllCommand extends Command
{
    protected static $defaultName = 'imk:generate:all';

    protected function configure()
    {
        $this
            ->setDescription('This command generate all :  dto, entity, forms and twig')
            ->addOption('namespace', '-n', InputOption::VALUE_OPTIONAL, 'Specific namespace');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $processDtoCmd = ['php', 'bin/console', 'odicee:generate:dto'];
        $processDto = new Process($processDtoCmd);
        $processDto->run();
        if ($processDto->isSuccessful()) {
            echo $processDto->getErrorOutput();
        }

        die;
        $processFormCmd = ['php', 'bin/console', 'odicee:generate:form'];
        $processForm = new Process($processFormCmd);
        $processForm->run();
        if ($processForm->isSuccessful()) {
            echo $processForm->getErrorOutput();
        }


        $processTwigCmd = ['php', 'bin/console', 'odicee:generate:twig'];
        $processTwig = new Process($processTwigCmd);
        $processTwig->run();
        if ($processTwig->isSuccessful()) {
            echo $processTwig->getErrorOutput();
        }

        $output->write('Generate calcul pack, now ...... ');
    }
}
