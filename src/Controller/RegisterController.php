<?php

namespace App\Controller;

use App\Entity\Register;
use App\Entity\Registero;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method createFormBuilder(Registero $user)
 */
class RegisterController extends AbstractController
{

    #[Route('/register', name: 'register')]
    public function new (\Symfony\Component\HttpFoundation\Request $request,  EntityManagerInterface $entityManager): Response
    {
        $user = new Registero();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();

            $entityManager->persist($user);
            $entityManager->flush();


            return $this->renderForm('register.html.twig');
        }

        return $this->renderForm('base.html.twig', [
            'form' => $form,

        ]);



    }



}