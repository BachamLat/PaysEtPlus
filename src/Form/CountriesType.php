<?php

namespace App\Form;

use App\Entity\Countries;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CountriesType extends AbstractType
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
            ->add('code', TextType::class, [
                'label'=> 'Code',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('dialCode', TextType::class, [
                'label'=> 'DialCode',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('longitude', IntegerType::class, [
                'label' => 'Longitude',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('latitude', IntegerType::class, [
                'label'=> 'Latitude',
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Countries::class,
        ]);
    }
}