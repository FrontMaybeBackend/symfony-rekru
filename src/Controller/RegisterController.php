<?php

namespace App\Controller;

use App\Entity\Register;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method createFormBuilder(Register $user)
 */
class RegisterController extends AbstractController
{

  #[Route('register')]
    public function new (\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $user = new Register();


        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('surname', TextType::class)
            ->add('email',TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Register'])->getForm();

        return $this->renderForm('base.html.twig', [
            'form' => $form,

        ]);



    }



}