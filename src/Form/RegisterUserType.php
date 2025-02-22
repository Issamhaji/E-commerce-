<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class , [
                'label' => 'your Email',
                'attr' => [
                    'placeholder' => 'Enter your email',
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'your Password',
                'attr' => [
                    'placeholder' => 'Enter your password',
                ],
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm your Password'],
                'mapped' => false,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'your Firstname',
                'attr' => [
                    'placeholder' => 'Enter your firstname',
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'your Lastname',
                'attr' => [
                    'placeholder' => 'Enter your lastname',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Register',
                'attr' => [
                    'class' => 'btn btn-success',
                ],
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
