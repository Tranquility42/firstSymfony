<?php


namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AnimalListType
{
    public function buildForm(FormBuilderInterface  $builder, array $options)
    {
        $builder
            ->add('animalName’' , TextType::class)
            ->add('ownerFirstName’)' , TextType::class)
            ->add('submit',SubmitType::class);
    }

}