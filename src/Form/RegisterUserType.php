<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Notifier\Texter;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class, [
                'label'=> "Votre adresse email",
                'attr'=> [
                    'placeholder'=> 'dupond@dupond.com'
                ]
            ])
            ->add('roles')
            ->add('firstname',TextType::class, [
                'label'=> 'Votre prénom',
                'attr'=>[
                    'placeholder'=> 'Jean'
                ]
            ])
            ->add('lastname',TextType::class, [
                'label'=> 'Votre nom',
                'attr'=> [
                    'placeholder'=> 'Dupond'
                ]
            ])
           
            ->add('plainPassword', RepeatedType::class, [
                'type'=> PasswordType::class,
                'constraints'=> [
                    new Length([
                        'min'=> 8,
                        'max'=> 50
                    ])
                ],
                'first_options'=>[
                    'label'=> 'votre mot de passe',
                    'attr'=> [
                    'placeholder'=> 'choisissez Votre mot de passe'
                    ],
                    'hash_property_path'=> 'password' ],
                'second_options'=>[
                    'label'=> 'Confirmez votre mot de passe',
                    'attr'=> [
                    'placeholder'=> 'Confirmer Votre mot de passe'
                    ] 
                    ], 
                   'mapped'=> false,
            ])
            ->add('submit', SubmitType::class, [
                'label'=> 'envoyez',
                'attr'=> [
                    'class'=> 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [
                new UniqueEntity([
                   'entityClass' => User::class,
                   'fields' => 'email' 
                ])
                ],
            'data_class' => User::class,
        ]);
    }
}
