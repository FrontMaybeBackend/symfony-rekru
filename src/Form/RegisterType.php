<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
class RegisterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class,[
                'label' => 'Username',
                'row_attr' => [
                    'class' => 'input-group',
                ],
            ])
            ->add('surname', TextType::class,[
                'label' => 'Surname',
                'row_attr' => [
                    'class' => 'input-group',
                ],
            ])
            ->add('email',EmailType::class,[
                'label' => 'Email ',
                'row_attr' => [
                    'class' => 'input-group',
                ],
            ])
            ->add('password',PasswordType::class,[
                'label' => 'Password',
                'row_attr' => [
                    'class' => 'input-group',
                    ],
            ])
            ->add('save', SubmitType::class)
        ;
    }

}