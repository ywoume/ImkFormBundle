<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

abstract class VersioningCmd extends Command implements VersioningInterface
{

    private $type = null;

    /**
     *
     */
    public function gitCommit(): void
    {
        $this->gitAddFiles();

        $cmdCommit = ['git', 'commit', '-m', 'Add somes DTO by odicee cmd - you can send boobs'];
        $processCommit = new Process($cmdCommit);
        $processCommit->run();
        if (!$processCommit->isSuccessful()) {
            throw new ProcessFailedException($processCommit);
        }
        $this->processDisplay($processCommit);
    }

    /**
     *
     */
    private function gitAddFiles(): void
    {
        $dir = $this->applyType();
        $cmdAddFileVersionning = ['git', 'add', __DIR__ . '/../Form/Operations/' . ucfirst($dir) . '/*.php'];
        $processAddFile = new Process($cmdAddFileVersionning);
        $processAddFile->start();
        $this->processDisplay($processAddFile);
    }

    private function applyType(): string
    {
        $validType = ['dto', 'form', 'calcul'];
        if (in_array($this->type, $validType)) {
            if ('dto' === $this->type) {
                $dir = 'Dto';
            } elseif ('form' === $this->type) {
                $dir = 'Type';
            } elseif ('calcul' === $this->type) {
                $dir = 'Calcul';
            }
        }
        return $dir;
    }

    public function setType(string $type): VersioningCmd
    {
        $this->type = $type;
        return $this;
    }

    private function processDisplay(Process $processAddFile): void
    {
        if ($processAddFile->isSuccessful()) {
            echo "---- Commit auto  ---------- ";
            echo $processAddFile->getErrorOutput();
            echo "---------------------------- ";
        }
        echo $processAddFile->getOutput();
    }
}