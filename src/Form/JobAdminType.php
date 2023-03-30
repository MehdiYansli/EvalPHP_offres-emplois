<?php

namespace App\Form;

use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',  TextType::class,  [  
                'label' => 'Nom de l\'annonce',          
                'attr' => [
                'class' => 'form-control w-50 my-3',
            ]])
            ->add('department',  NumberType::class,  [
                'label' => 'N° de département',            
                'attr' => [
                'class' => 'form-control w-50 my-3',
            ]])
            ->add('city',  TextType::class,  [                
                'label' => 'Ville',   
                'attr' => [
                'class' => 'form-control w-50 my-3',
            ]])
            ->add('description',  TextareaType::class,  [            
                'attr' => [
                'class' => 'form-control w-50 my-3',
            ]])
            ->add('sendAt',  DateType::class,  [      
                'input' => 'datetime_immutable',
                'label' => 'Envoyé le',
                'widget' => 'single_text' ,   
                'attr' => [
                'class' => 'form-control w-50 my-3',
            ]])
            ->add('endDate',  DateType::class,  [            
                'label' => 'Sera supprimée le',
                'widget' => 'single_text' ,   
                'attr' => [
                'class' => 'form-control w-50 my-3',
            ]])
            ->add('salary',  MoneyType::class,  [
                'label' => 'Salaire',            
                'attr' => [
                'class' => 'form-control w-50 my-3',
            ]])
            ->add('type',  ChoiceType::class,  [
                'label' => 'Type de contrat', 
                'attr' => [
                    'class' => 'form-select w-50 my-3'
                ],
                'choices' => [
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Intérime' => 'Intérime',
                    'Alternance' => 'Alternance',
                    'Stage' => 'Stage' ,
            ],          
           ])
            ->add('duration',  TextType::class,  [
                'label' => 'Durée du contrat',            
                'attr' => [
                'class' => 'form-control w-50 my-3',
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
