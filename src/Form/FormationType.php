<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Session;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Designation')
            ->add('description')
            ->add('photo')
            ->add('dateDeb')
            ->add('dateFin')
            ->add('niveau')
            ->add('etat',  ChoiceType::class, [
                    'choices'  => [
                        'Open' => 'Open' ,
                        'Close' => 'Close',
                    ]]
            )

            ->add('session', EntityType::class,
                [
                    'class'=>Session::class,
                    'choice_label'=>'designation'
                ])
            ->add('user', EntityType::class,
                [
                    'class'=>User::class,
                    'choice_label'=>'nom'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
