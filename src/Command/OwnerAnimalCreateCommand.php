<?php

namespace App\Command;

use App\Entity\Animal;
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

class OwnerAnimalCreateCommand extends Command
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

    protected static $defaultName = 'app:create-owner-animal';
    protected static $defaultDescription = 'Create an animal and an Owner ';

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
        ->setDescription('Create an animal and an Owner')
        ->setHelp('This command create an animal and an Owner')
        ->addArgument('animalName',InputArgument::REQUIRED, 'the animal name')
        ->addArgument('OwnerName',InputArgument::REQUIRED, 'the owner name');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $owner = new Owner();
        $animal = new Animal();

        $nameOwner = $input->getArgument('OwnerName');
        $nameAnimal = $input->getArgument('animalName');
        $owner->setFirstName($nameOwner);
        $animal->setNickName($nameAnimal);
        $animal->setOwner($owner);
        $animal->setType('chien');
        $this->em->persist($animal);
        $this->em->flush();


        $output->writeln("Owner and Animal created ");
        return Command::SUCCESS;
    }
}
