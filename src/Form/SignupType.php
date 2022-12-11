<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'label' => 'first_name',
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'attr' => ['placeholder' => 'firstName'],
            ])
            ->add('lastName', null, [
                'label' => 'last_name',
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'attr' => ['placeholder' => 'lastName'],
            ])->add('email', EmailType::class, [
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'attr' => ['placeholder' => 'email', 'class' => 'mt-2'],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'label' => 'password',
                    'row_attr' => [
                        'class' => 'form-floating',
                    ],
                    'attr' => ['placeholder' => 'password', 'class' => 'mt-2'],
                ],
                'second_options' => [
                    'label' => 'confirm_password',
                    'attr' => ['placeholder' => 'confirm_password', 'class' => 'mt-2'],
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
