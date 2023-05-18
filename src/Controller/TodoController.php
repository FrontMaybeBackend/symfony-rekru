<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Entity\TodoList;
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

        $user = $this->getUser();// pobierz użytkownika z bazy danych lub innego źródła
        $form = $this->createForm(TodoType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todo = new Todo();
            $todo->setName($form->get('todoName')->getData());

            $todoList = new TodoList();
            $todoList->setUser($user);
            $todoList->setTask($form->get('task')->getData());
            $todoList->setTodo($todo);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($todo);
            $entityManager->persist($todoList);
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

#[Route('/tasks',name: 'names_details')]
public function todoDetails(Request $request, TodoRepository $todoRepository)
{
    $todoId = $request->query->get('id');
    $user = $this->getUser();

    // Pobierz obiekt Todo na podstawie ID
    $todo = $todoRepository->find($todoId);

    if (!$todo) {
        throw $this->createNotFoundException('Nie znaleziono zadania o podanym ID.');
    }

    // Pobierz listę TodoList przypisanych do danego Todo dla zalogowanego użytkownika
    $todoLists = $todo->getTodolist();

    return $this->render('todo/names_details.html.twig', [
        'todo' => $todo,
        'todoLists' => $todoLists,
    ]);
}


}