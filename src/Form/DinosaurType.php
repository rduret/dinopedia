<?php

namespace App\Form;

use App\Entity\Dinosaur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DinosaurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('typeSpecies')
            ->add('size')
            ->add('weight')
            ->add('period')
            ->add('food')
            ->add('environment')
            ->add('localization')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dinosaur::class,
        ]);
    }
}
