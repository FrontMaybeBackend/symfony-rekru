<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
              // get the login error if there is one
               $error = $authenticationUtils->getLastAuthenticationError();

            // last username entered by the user
               $lastUsername = $authenticationUtils->getLastUsername();

        if ($request->query->getBoolean('registration_success')) {
            $this->addFlash('success', 'Rejestracja przebiegła pomyślnie. Możesz teraz się zalogować.');
        }

          return $this->render('login/index.html.twig', [

                        'last_username' => $lastUsername,
                          'error'         => $error,
          ]);

      }


}
