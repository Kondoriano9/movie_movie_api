<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Service\TmdbReader;

class TmdbCommand extends Command
{
    protected static $defaultName = 'Tmdb';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg = $input->getArgument('arg');

        if ($arg) {
            if (!$this->checkArgs($arg)) {
                $io->caution(sprintf('Not valid argument %s', $arg));
                exit;
            } else {
                $io->note(sprintf('You passed an argument: %s', $arg));
            }
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $tmdbReader = new TmdbReader($arg);
        $resultTmdbReader = $tmdbReader->loadData();
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }

    protected function checkArgs($arg)
    {
        switch ($arg) {
            case "lastMovies":
            break;
            default:
            return false;
        }
        return true;
    }
}
