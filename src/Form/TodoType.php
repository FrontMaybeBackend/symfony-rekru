<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TodoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('todoName', TextType::class, [
                'label' => 'Todo Name',
                'row_attr' => [
                    'class' => 'input-group',
                ],
            ])
            ->add('AddTodoList', SubmitType::class,[
                'attr' => [
                    'class' => 'btn-dark',
                ],
            ]);
    }


}