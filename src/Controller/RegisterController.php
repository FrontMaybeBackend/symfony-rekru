<?php

namespace App\Controller;

use App\Entity\Register;
use App\Entity\Registero;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method createFormBuilder(Registero $user)
 */
class RegisterController extends AbstractController
{

    #[Route('/register', name: 'app_register')]
    public function new (\Symfony\Component\HttpFoundation\Request $request,  EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            $user = $form->getData();

            $entityManager->persist($user);
            $entityManager->flush();


            return $this->renderForm('register/base.html.twig');
        }

        return $this->renderForm('register/register.html.twig', [
            'form' => $form,

        ]);



    }



}