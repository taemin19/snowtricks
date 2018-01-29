<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', null, [
                'label_attr' => ['class' => 'sr-only'],
                'attr' => [
                    'placeholder' => 'Full name',
                    'autofocus' => ''
                ]
            ])
            ->add('email', EmailType::class, [
                'label_attr' => ['class' => 'sr-only'],
                'attr' => ['placeholder' => 'Email']
            ])
            ->add('username', null, [
                'label_attr' => ['class' => 'sr-only'],
                'attr' => ['placeholder' => 'Username']
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label_attr' => ['class' => 'sr-only'],
                    'attr' => [
                        'placeholder' => 'Password',
                        'autocomplete' => 'off'
                    ]
                ],
                'second_options' => [
                    'label_attr' => ['class' => 'sr-only'],
                    'attr' => [
                        'placeholder' => 'Repeat Password',
                        'autocomplete' => 'off'
                    ]
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
