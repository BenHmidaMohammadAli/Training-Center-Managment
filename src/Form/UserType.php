<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Organisme;
use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            //->add('roles')
            ->add('password',PasswordType::class)

            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('DateNaissance')
            ->add('NumeroTel')
            ->add('Education')
            ->add('Niveau',  ChoiceType::class, [
                'choices'  => [
                    'Beginner' => 'Beginner' ,
                    'Junior' => 'Junior',
                    'Confirmed' => 'Confirmed',
                    'Sinior' => 'Sinior',
                            ]]
            )

            ->add('diplome')

            ->add('organisme', EntityType::class,
            [
                'class'=>Organisme::class,
                'choice_label'=>'nom'
            ])
            ->add('Competence', EntityType::class,
                [
                    'class'=>Competence::class,
                    'choice_label'=>'designation'
                ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
