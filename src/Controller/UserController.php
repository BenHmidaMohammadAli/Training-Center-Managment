<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('DashboardAdmin/user')]
class UserController extends AbstractController
{
    #[Route('/IndexAdmin', name: 'app_admin_index', methods: ['GET'])]
    public function index_admin(UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('user/index.html.twig', [
            'users'=> $userRepository->findBy(array('Role' => 1)),
            'UserRole'=>'List of admins',
            'RoleID'=>1,
            'user' => $user
        ]);
    }
    #[Route('/IndexTrainer', name: 'app_trainer_index', methods: ['GET'])]
    public function index_trainer(UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findBy(array('Role' => 3)),
            'UserRole'=>'List of Trainers',
            'RoleID'=>3,
            'user' => $user
        ]);
    }
    #[Route('/IndexStudent', name: 'app_student_index', methods: ['GET'])]
    public function index_student(UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findBy(array('Role' => 2)),
            'UserRole'=>'List of students',
            'RoleID'=>2,
            'user' => $user
        ]);
    }

    #[Route('/newAdmin', name: 'app_admin_new', methods: ['GET', 'POST'])]
    public function newAdmin(Request $request, UserRepository $userRepository): Response
    {
        $user1=$this->getUser() ;
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$user->setRoles([$request->request->get('role')]);
            $user->setRole(1);
            $userRepository->add($user);

            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user1,
            'form' => $form,
            'ROLE'=> 1
        ]);
    }

    #[Route('/newStudent', name: 'app_student_new', methods: ['GET', 'POST'])]
    public function newStudent(Request $request, UserRepository $userRepository): Response
    {
        $user1=$this->getUser() ;
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRole(2);
            $userRepository->add($user);

            return $this->redirectToRoute('app_student_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user1,
            'form' => $form,
            'ROLE'=> 2
        ]);
    }
    #[Route('/newTrainer', name: 'app_trainer_new', methods: ['GET', 'POST'])]
    public function newTrainer(Request $request, UserRepository $userRepository): Response
    {
        $user1=$this->getUser() ;
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRole(3);
            $userRepository->add($user);

            return $this->redirectToRoute('app_trainer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user1,
            'form' => $form,
            'ROLE'=> 3
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        $user1=$this->getUser() ;
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'ROLE'=> $user->getRole()->getId()
        ]);
    }


    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $user1=$this->getUser() ;
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user1,
            'form' => $form,
            'ROLE'=> $user->getRole()->getId()
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_user_index', ['user' => $user], Response::HTTP_SEE_OTHER);
    }
}
