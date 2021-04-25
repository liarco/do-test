<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;

class CreateSessionDbTableCommand extends Command
{
    protected static $defaultName = 'app:create-session-db-table';
    protected static $defaultDescription = 'Creates a DB table to store sessions data';

    private PdoSessionHandler $pdoSessionHandler;

    public function __construct(PdoSessionHandler $pdoSessionHandler, string $name = null)
    {
        parent::__construct($name);
        $this->pdoSessionHandler = $pdoSessionHandler;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        try {
            $this->pdoSessionHandler->createTable();
        } catch (\PDOException $exception) {
            throw $exception;
        }

        $io->success('Sessions table initialized successfully!');

        return Command::SUCCESS;
    }
}
