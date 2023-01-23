<?php

namespace App\Form;

use App\Entity\Seance;
use App\Entity\Presence;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('etat',  ChoiceType::class, [
                    'choices'  => [
                        'Present' => 'Present' ,
                        'Absent' => 'Absent'
                    ]]
            )

            ->add('Seance', EntityType::class,
                [
                    'class'=>Seance::class,
                    'choice_label'=>'Id'
                ])
            ->add('User', EntityType::class,
                [
                    'class'=>User::class,
                    'choice_label'=>'nom'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Presence::class,
        ]);
    }
}
