<?php

namespace App\Form;

use App\Entity\Attack;
use App\Entity\Generation;
use App\Entity\Pokemon;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name',TextType::class, [
                'label' =>'Name',
                'attr' => [
                    'placeholder' => 'Enter Pokemon Name\'s',
                    'class' => 'mt-3 mb-3 form-control',
            ]])
            ->add('Description',TextareaType::class, [
                'label' =>'Decription',
                'attr' => [
                    'class' => 'mt-3 mb-3 form-control',
                ]])
            ->add('numeroNationnal',IntegerType::class, [
                'label' =>'Nationnal number',
                'attr' => [
                    'class' => 'mt-3 mb-3 form-control',
                ]])
            ->add('numeroPokedex',IntegerType::class, [
                'label' =>'Pokedex number',
                'attr' => [
                    'class' => 'mt-3 mb-3 form-control',
                ]])
            ->add('picture',TextType::class, [
                'label' =>'Picture',
                'attr' => [
                    'placeholder' => 'Enter Pokemon\'s Picture',
                    'class' => 'mt-3 mb-3 form-control',
            ]])
            ->add('generation',EntityType::class, [
                'class' => Generation::class,
                'choice_label' => 'label',
                'multiple' => true,
                'mapped' => false,
                'attr' => [
                    'class' => 'col-3'
                ]                  
            ])
            ->add('types',EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'col-3'
                ]                  
            ])
            ->add('attacks',EntityType::class, [
                'class' => Attack::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'col-3'
                ]                  
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
