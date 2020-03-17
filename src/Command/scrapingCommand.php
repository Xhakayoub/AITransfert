<?php

namespace App\Src\Command;

use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Services\updateAllData;

class scrapingCommand extends Command
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this->setName('data:update')
            ->setDescription('update data');
    }

    public function update()
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output, updateAllData $service)
    {

        $io = new SymfonyStyle($input, $output);

        $io->title('import en progression...');

        $service->mainFunction();
        echo "done!";

        $io->success('importation avec succÃ©s');
    }
}
