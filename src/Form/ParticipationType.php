<?php

namespace App\Form;

use App\Entity\Participation;
use App\Entity\Formation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('etat')

            ->add('etat',  ChoiceType::class, [
                    'choices'  => [
                        'Pending' => 'Pending' ,
                        'Accepted' => 'Accepted',
                        'Not Accepted'=> 'Not Accepted'
                    ]]
            )

            ->add('Formation', EntityType::class,
                [
                    'class'=>Formation::class,
                    'choice_label'=>'Designation'
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
            'data_class' => Participation::class,
        ]);
    }
}
