<?php

namespace Imk\FormBundle\Command;

use App\Services\Operations\OperationsManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateFormCommand extends ImkVersioningCmd
{
    protected static $defaultName = 'imk:generate:form';
    /**
     * @var OperationsManager
     */
    private $operationsManager;

    /**
     * ImkGenerateFormCommand constructor.
     * @param OperationsManager $operationsManager
     * @param string|null $name
     */
    public function __construct(OperationsManager $operationsManager, string $name = null)
    {
        parent::__construct($name);
        $this->operationsManager = $operationsManager;
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
        if ($increase) {
            $io->note(sprintf('You passed an argument: %s', $increase));
            $increase = true;
        } else {
            $increase = false;
        }
        $allOps = $this->operationsManager->getAllOperations();
        $this->operationsManager->buildForm($allOps, $increase);
        $io->success('You have generate form for Imk, now send boobs in slack ;) ');

        if ($increase && $increase == 'git') {
            $this->setType('form')->gitCommit();
            $io->success('You have added in Git these file , now send boobs in slack ;) ');
        }

    }
}
