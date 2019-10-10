<?php


namespace Imk\AuthBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ImkAuthCreateUser extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'imk:create-user';

    protected function configure()
    {
        $this
            ->setDescription('imk cmd for create user');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln('Create new database. ');
        $processCreate = new Process(['php', 'bin/console', 'doctrine:database:create']);
        $processCreate->run();
        echo $processCreate->getOutput();

        $processUpdate = new Process(['php', 'bin/console', 'doctrine:schema:update', '--force']);
        $processUpdate->run();
        echo $processUpdate->getOutput();


        $output->writeln('done . ');
    }
}
