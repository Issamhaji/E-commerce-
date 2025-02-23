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
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Enter your password',
                ],
                'first_options' => ['label' => 'Your Password', 'hash_property_path' => 'password'],
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
            'constraints' => [
                new UniqueEntity([
                    'fields' => 'email',
                    'message' => 'This email is already used',
                ]),
            ],
            'data_class' => User::class,
        ]);
    }
}
