<?php

namespace App\Form;

use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class JobSortType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('department', ChoiceType::class, [                
                'attr' => [
                'class' => 'btn btn-primary dropdown-toggle rounded',
            ],
                'label' => 'Département',
                'choices' => [
                    'department' => $this->getDpts(),
                ],
                'placeholder' => 'Département',
                'required' => false
            ])
            // ->add('city')
            ->add('type', ChoiceType::class, [                
                'attr' => [
                'class' => 'btn btn-primary dropdown-toggle',
            ],
                'label' => 'Type de contrat',
                'choices' => [
                        'CDI' => 'CDI',
                        'CDD' => 'CDD',
                        'Intérim' => 'Intérim',
                        'Alternance' => 'Alternance',
                        'Stage' => 'Stage' ,
                ],
                'placeholder' => 'Type de contrat',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }

    private function getDpts(): array
    {
        $dpts = [];
        for($i=1; $i < 100; $i++) {
            $dpts["Département - $i"]= $i;
        }
        return $dpts;
    }
}
