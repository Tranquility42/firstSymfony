<?php

namespace App\Command;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use App\Repository\OwnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeAnimalCommand extends Command
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

    protected static $defaultName = 'app:test-command-second';

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
            ->setDescription('create an animal')
            ->setHelp('This command create an animal')
            ->addArgument('animalName',InputArgument::REQUIRED, 'the animal name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        $owner = $this->ownerRepository->find(10);

        $animal = new Animal();
        $nickName = $input->getArgument('animalName');
        $animal->setNickName($nickName);
        $animal->setType('Lion');
        $animal->setOwner($owner);
        $this->em->persist($animal);
        $this->em->flush();



        $output->writeln("l'animal " . $nickName . " a bien été crée ");
        return Command::SUCCESS;

    }
}
