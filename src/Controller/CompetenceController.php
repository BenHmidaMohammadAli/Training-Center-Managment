<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('DashboardAdmin/competence')]
class CompetenceController extends AbstractController
{

    #[Route('/', name: 'app_competence_index', methods: ['GET'])]
    public function index(CompetenceRepository $competenceRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('competence/index.html.twig', [
            'competences' => $competenceRepository->findAll(),
            'user' => $user
        ]);
    }

    #[Route('/new', name: 'app_competence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompetenceRepository $competenceRepository): Response
    {
        $user=$this->getUser() ;
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competenceRepository->add($competence);
            return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competence/new.html.twig', [
            'competence' => $competence,
            'form' => $form,
            'user' => $user
        ]);
    }

    #[Route('/{id}', name: 'app_competence_show', methods: ['GET'])]
    public function show(Competence $competence): Response
    {
        $user=$this->getUser() ;
        return $this->render('competence/show.html.twig', [
            'competence' => $competence,
            'user' => $user
        ]);
    }

    #[Route('/{id}/edit', name: 'app_competence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Competence $competence, CompetenceRepository $competenceRepository): Response
    {
        $user=$this->getUser() ;
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competenceRepository->add($competence);
            return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competence/edit.html.twig', [
            'competence' => $competence,
            'form' => $form,
            'user' => $user
        ]);
    }

    #[Route('/{id}', name: 'app_competence_delete', methods: ['POST'])]
    public function delete(Request $request, Competence $competence, CompetenceRepository $competenceRepository): Response
    {
        $user=$this->getUser() ;
        if ($this->isCsrfTokenValid('delete'.$competence->getId(), $request->request->get('_token'))) {
            $competenceRepository->remove($competence);
        }

        return $this->redirectToRoute('app_competence_index', ['user' => $user], Response::HTTP_SEE_OTHER);
    }
}
