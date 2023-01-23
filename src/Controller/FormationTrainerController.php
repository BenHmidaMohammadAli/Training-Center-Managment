<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('DashboardFormateur/formation')]
class FormationTrainerController extends AbstractController
{

    #[Route('/MyList', name: 'app_formation_index_trainer_List', methods: ['GET'])]
    public function indexTrainerList(FormationRepository $formationRepository): Response
    {
        $user=$this->getUser() ;

        return $this->render('formation/indexTrainerList.html.twig', [
            'formations'=> $formationRepository->findBy(array('user' => $user)),
            'user' => $user
        ]);
    }

    #[Route('MyList/{id}', name: 'app_formation_show_Trainer', methods: ['GET'])]
    public function show(Formation $formation): Response
    {
        $user=$this->getUser() ;
        return $this->render('formation/showTrainer.html.twig', [
            'formation' => $formation,
            'user' => $user
        ]);
    }
}
