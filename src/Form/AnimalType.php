<?php


namespace App\Form;

use App\Entity\Animal;
use App\Entity\Owner;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;


class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickName', TextType::class,[
                'constraints' => [
                    new NotNull([
                        'message' => 'vous devez donné un nickname avotre animal'
                    ]),
                    new Length([
                        'min'=> 5,
                        'max'=>20,
                        'minMessage'=> 'le nikName doit faire 5 carac mini',
                        'maxMessage'=> 'le nikName doit faire 20 carac maxi',
                    ])

                ]

            ])
            ->add('type' , TextType::class)
            ->add('owner',EntityType::class,[
                'class' => Owner::class,
                'choice_label' => 'firstName'
            ])
            ->add('submit',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
