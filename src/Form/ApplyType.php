<?php

namespace App\Form;

use App\Entity\Apply;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ApplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('last_name', TextType::class, [
                'attr' => ['class' => 'form-control', 
                            'placeholder' => 'Nom'],
            ])
        ->add('first_name', TextType::class, [
            'attr' => ['class' => 'form-control', 
                        'placeholder' => 'Prénom'],
        ])
        ->add('email', EmailType::class, [
            'attr' => ['class' => 'form-control', 
                        'placeholder' => 'nom.prenom@exemple.com'],
        ])
        ->add('message', TextareaType::class, ['label' => 'Votre candidature',
        'attr' => ['class' => 'form-control', 
        'placeholder' => 'Votre message...'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apply::class,
        ]);
    }
}
