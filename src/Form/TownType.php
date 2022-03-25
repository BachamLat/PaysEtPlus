<?php

namespace App\Form;

use App\Entity\Town;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class TownType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Name',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'Longitude',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('latitude', NumberType::class, [
                'label'=> 'Latitude',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('district')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Town::class,
        ]);
    }
}
