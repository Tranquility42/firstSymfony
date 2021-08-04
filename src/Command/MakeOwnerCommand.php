<?php

namespace App\Command;

use App\Entity\Owner;
use App\Repository\AnimalRepository;
use App\Repository\OwnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeOwnerCommand extends Command
{
    /**
     * @var AnimalRepository
     */
    private $animalRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    /**
     * @var OwnerRepository
     */
    private $ownerRepository;


    protected static $defaultName = 'app:make-owner';
    protected static $defaultDescription = 'creer un owner ';

    /**
     * TestCommand constructor.
     * @param AnimalRepository $animalRepository
     * @param EntityManagerInterface $em
     * @param OwnerRepository $ownerRepository
     */
    public function __construct(AnimalRepository $animalRepository, EntityManagerInterface $em, OwnerRepository $ownerRepository)
    {
        parent::__construct();

        $this->animalRepository = $animalRepository;
        $this->em = $em;
        $this->ownerRepository = $ownerRepository;
    }


    protected function configure(): void
    {
        $this
            ->setDescription('create an Owner')
            ->setHelp('This command create an Owner');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $owner = new Owner();
        $owner->setFirstName('kahlouch');
        $owner->setLastName('mkacha5');
        $this->em->persist($owner);
        $this->em->flush();

        $output->writeln("Owner created");
        return Command::SUCCESS;
    }


}
