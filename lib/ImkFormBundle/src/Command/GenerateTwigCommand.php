<?php


namespace Imk\FormBundle\Command;


use App\Services\Operations\OperationsManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class GenerateTwigCommand extends Command
{
    protected static $defaultName = 'imk:generate:twig';
    /**
     * @var OperationsManager
     */
    private $operationsManager;

    public function __construct(OperationsManager $operationsManager, string $name = null)
    {
        parent::__construct($name);
        $this->operationsManager = $operationsManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Its generate a twig files for operation')
            ->addArgument('increase', InputArgument::OPTIONAL, 'Argument description');;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \Exception
     */
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

        try {
            $this->operationsManager->buildTwig($allOps, $increase);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        $io->success('You have generate form for odicee, now send (shuuuttttt ....) ');

        if ($increase && $increase == 'git') {
            $this->setType('form')->gitCommit();
            $io->success('You have added in Git these file , now send boobs in slack ;) ');
        }
        $io->write('Generate calcul pack,  now send (shuuuttttt ....)', true);
    }
}