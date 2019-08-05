<?php

namespace Imk\FormBundle\Command;

use Imk\FormBundle\Utils\ImkCmdManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateFormCommand extends Command
{
    protected static $defaultName = 'imk:generate:form';
    /**
     * @var ImkCmdManager
     */
    private $imkCmdManager;

    /**
     * ImkGenerateFormCommand constructor.
     * @param ImkCmdManager $imkCmdManager
     */
    public function __construct(ImkCmdManager $imkCmdManager)
    {
        parent::__construct();
        $this->imkCmdManager = $imkCmdManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('its command for generate form for Imk')
            ->addArgument('increase', InputArgument::OPTIONAL, 'Argument description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $increase = $input->getArgument('increase');
        /*if ($increase) {
            $io->note(sprintf('You passed an argument: %s', $increase));
            $increase = true;
        } else {
            $increase = false;
        }*/
        $allOps = $this->imkCmdManager->allForms();
        $this->imkCmdManager->buildDto($allOps);
        $io->success('You have generate form for Imk, now send boobs in slack ;) ');

        if ($increase && $increase == 'git') {
            $this->setType('form')->gitCommit();
            $io->success('You have added in Git these file , now send boobs in slack ;) ');
        }

    }
}
