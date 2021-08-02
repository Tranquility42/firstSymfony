<?php


namespace App\Twig;


use App\Repository\AnimalRepository;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TextExtension extends AbstractExtension
{


    /**
     * @var AnimalRepository
     */
    private $animalRepository;
    /**
     * @var Environment
     */
    private $twigEnvironement;

    /**
     * TextExtension constructor.
     * @param AnimalRepository $animalRepository
     * @param Environment $twigEnvironement
     */
    public function __construct(AnimalRepository $animalRepository, Environment $twigEnvironement)
    {
        $this->animalRepository = $animalRepository;
        $this->twigEnvironement = $twigEnvironement;
    }

    /**
     * TextExtension constructor.
     * @return TwigFilter[]
     */

    public function getFilters()
    {
        return [
            new TwigFilter('first_letter_uppercase', [$this, 'firstLetterUppercase']),
            new TwigFilter('get_letter_count',[$this,'getLetterCount']),
            new TwigFilter('first_letter_color' ,[$this,'firstLetterColor'])

        ];
    }
    public function getFunctions()
    {
        return [
            new TwigFunction('get_animal_entities', [$this, 'getAnimalEntities']),
            new TwigFunction('generate_simple_html',[$this,'generateSimplehHtml']),
            new TwigFunction('get_animals_count',[$this,'getAnimalsCount'])

        ];
    }


    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function firstLetterColor($string)
    {
       $firstLetter =$string[0];
       $nextContent= substr($string, 1);

       return $this->twigEnvironement->render('Partial/simple.html.twig', [
           'foo'=> $firstLetter,
           'n'=> $nextContent
       ]);
    }
    public function firstLetterUppercase($string)
    {
        return ucfirst($string);
    }
    public function getAnimalEntities()
    {
        return $this->animalRepository->findAll();
    }
    public function generateSimplehHtml()
    {
        return $this->twigEnvironement->render('partial/simple.html.twig');
    }
    public function getLetterCount(string  $string)
    {
        $nb=0;
        $str = (str_split($string));
        foreach ( $str as $letter ){
            if ($letter == 'j'){
                $nb++;
            }
        }
        return $nb;
    }
    public function getAnimalsCount()
    {
        return count($this->animalRepository->findAll());

    }




}