<?php

namespace App\Command;


use App\Services\Operations\OperationsManager;
use Imk\FormBundle\Utils\ImkCmdManager;
use League\Flysystem\FileExistsException;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;
use Symfony\Component\Process\Exception\ProcessFailedException;

class GenerateDtoCommand extends VersioningCmd
{
    protected static $defaultName = 'imk:generate:dto';

    /**
     * @var ImkCmdManager
     */
    private $cmdManager;

    /**
     * ImkCmdManager constructor.
     * @param ImkCmdManager $cmdManager
     * @param string|null $name
     */
    public function __construct(ImkCmdManager $cmdManager, string $name = null)
    {
        parent::__construct($name);
        $this->cmdManager = $cmdManager;
    }


    protected function configure()
    {
        $this
            ->setDescription('Build DTO class ')
            ->addArgument('increase', InputArgument::OPTIONAL, 'If you want to inscrease the existing ');

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws InvalidArgumentException
     * @throws FileNotFoundException
     * @throws IOException
     * @throws DirectoryNotFoundException
     * @throws ProcessFailedException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $io = new SymfonyStyle($input, $output);
        $arg = $input->getArgument('increase');

        $allOps = $this->cmdManager->getAllOperations();

        if ($arg && $arg == 'increase') {
            $io->write('You want to increase all existing class');
            $io->note(sprintf('You passed an argument: %s', $arg));
            $increase = true;
        } else {
            $increase = false;
        }
        $this->cmdManager->buildDto($allOps, $increase);
        $io->success('You have created dto, send boobs now in slack. ;)');

        if ($arg && $arg == 'git') {

            $this->setType('dto')->gitCommit();
            $io->success('You have versionned in git DTO, you can send boobs now in slack. ;)');
        }

    }


}
