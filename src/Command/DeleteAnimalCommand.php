<?php

namespace App\Command;

use App\Repository\AnimalRepository;
use App\Repository\OwnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DeleteAnimalCommand extends Command
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

    protected static $defaultName = 'app:delete-animal-by-id';

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

        ->setDescription('delete an animal')
        ->setHelp('This command delete an animal')
        ->addArgument('id',InputArgument::REQUIRED, 'the animal id');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        $idAnimal = $input->getArgument('
        id');
        $animal = $this->animalRepository->find($idAnimal);
        $this->em->remove($animal);
        $this->em->flush();
        $output->writeln("l'animal avec l'id  " . $idAnimal . " a bien été supprimé ");

        return Command::SUCCESS;
    }
}
