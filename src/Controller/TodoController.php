<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoItemRepository;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function new(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
         $task = new Todo();
         $form = $this->createForm(TodoType::class, $task);

         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
             $task = $form->getData();

             $entityManager->persist($task);
             $entityManager->flush();

             return $this->redirectToRoute('app_todo');

         }

        $task = $doctrine->getRepository(Todo::class)->findAll();

        // Renderuj widok index.html.twig, przekazując formularz i zadania
        return $this->renderForm('todo/index.html.twig', [
            'form' => $form,
            'name' => $task,
        ]);


    }




}
