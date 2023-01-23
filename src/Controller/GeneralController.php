<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Participation;
use App\Entity\User;
use Laminas\Code\Generator\DocBlock\Tag\ParamTag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class GeneralController extends AbstractController
{

    /**
     * @Route ("/", name="PageIndex")
     */
    public function Index(): Response
    {
        $em =$this->getDoctrine()->getManager();

        $listSession =$em->getRepository("App\Entity\Session")->findAll() ;

        $listTrainer =$em->getRepository("App\Entity\User")->findBy(array('Role' => 3)) ;

        return $this->render('PageAcceuil/index.html.twig',
            [
                'sessions'=>$listSession,
                'trainers'=>$listTrainer,
            ]
            );
    }

    /**
     * @Route ("/PageAbout", name="PageAbout")
     */
    public function About(): Response
    {
        return $this->render('PageAcceuil/about.html.twig',[]
        );
    }
    /**
     * @Route ("/PageContact", name="PageContact")
     */
    public function IndexContact(): Response
    {
        return $this->render('PageAcceuil/contact.html.twig',[]
        );
    }
    /**
     * @Route ("/PageCourse", name="PageCourse")
     */
    public function PageCourse(): Response
    {
        $em =$this->getDoctrine()->getManager();

        $listFormation =$em->getRepository("App\Entity\Formation")->findAll() ;

        return $this->render('PageAcceuil/course.html.twig',
            [
                'Trainings'=>$listFormation,
            ]
        );
    }


    #[Route('/PageDetails/{id}', name: 'PageDetails', methods: ['GET'])]
    public function PageDetails(Formation $training): Response
    {
        return $this->render('PageAcceuil/detail.html.twig',
            [
                'training'=>$training,

            ]
        );
    }

    #[Route('/Enrole/{id}', name: 'Enrole', methods: ['GET'])]

    public function Enrole(Formation $training): Response
    {

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            $user = $this->getUser() ;

            $participation = new Participation() ;
            $participation->setDate(new \DateTime('now'));
            $participation->setEtat("Pending");
            $participation->setFormation($training);
            $participation->getUser($user);

            $em =$this->getDoctrine()->getManager();

            $em->getRepository("App\Entity\Participation")->add($participation) ;

            $MyParticipation =$em->getRepository("App\Entity\Participation")->findBy(['user'=>$user]) ;
            return $this->render('PageAcceuil/List.html.twig',
                ['MyParticipations'=>$MyParticipation]
            );
        }else{
            return $this->render('Template-login.html.twig',[]
            );



        }

    }

    /**
     * @Route ("/ListPart", name="ListPart")
     */
    public function ListPart(): Response
    {
        $user = $this->getUser() ;

        $em =$this->getDoctrine()->getManager();

//        $MyParticipation =$em->getRepository("App\Entity\Participation")->findBy(['user'=>$user]) ;
        $MyParticipation =$em->getRepository("App\Entity\Participation")->findAll() ;
        return $this->render('PageAcceuil/List.html.twig',
            [
                'MyParticipations'=>$MyParticipation ,
            ]
        );
    }

    #[Route('/part/{id}', name: 'app_participationStudent_show', methods: ['GET'])]
    public function detailPart(Participation $participation): Response
    {
        return $this->render('PageAcceuil/detailsFormation.html.twig', [
            'participation' => $participation,
        ]);

    }

    /**
     * @Route ("/DashboardAdmin", name="DashboardAdmin")
     */
    public function DashboardAdmin(): Response
    {
        $user=$this->getUser() ;
        return $this->render('general/DashboardAdmin.html.twig',
            ['user' => $user,]);
    }

    /**
     * @Route ("/DashboardFormateur", name="DashboardFormateur")
     */
    public function DashboardFormateur(): Response
    {
        $user=$this->getUser() ;
        return $this->render('general/DashboardFormateur.html.twig',
            ['user' => $user,]);
    }

    /**
     * @Route ("/DashboardEtudiant", name="DashboardEtudiant")
     */
    public function DashboardEtudiant(): Response
    {
        return $this->render('general/DashboardEtudiant.html.twig', []);
    }

    /**
     * @Route ("DashboardAdmin/Statics", name="Statics")
     */
    public function Statics(): Response
    {
        $user=$this->getUser() ;
        return $this->render('Statics.html.twig', ['user' => $user,]);
    }

    /**
     * @Route ("DashboardFormateur/StaticsTrainer", name="StaticsTrainer")
     */
    public function StaticsTrainer(): Response
    {
        $user=$this->getUser() ;
        return $this->render('StaticsTrainer.html.twig', ['user' => $user,]);
    }

    /**
     * @Route ("DashboardFormateur/ShowProfil", name="ShowProfilTrainer")
     */
    public function ShowProfilTrainer(): Response
    {
        $user=$this->getUser() ;
        return $this->render('Template-profilTrainer.html.twig',
            ['user' => $user,]);
    }

    /**
     * @Route ("DashboardAdmin/ShowProfil", name="ShowProfil")
     */
    public function ShowProfil(): Response
    {
        $user=$this->getUser() ;
        return $this->render('Template-profil.html.twig',
            ['user' => $user,]);
    }


    /**
     * @Route ("DashboardAdmin/Contact", name="Contact")
     */
    public function Contact(): Response
    {
        $user=$this->getUser() ;
        return $this->render('contact.html.twig',
            ['user' => $user,]);
    }

    /**
     * @Route ("DashboardFormateur/Contact", name="Contact")
     */
    public function ContactTrainer(): Response
    {
        $user=$this->getUser() ;
        return $this->render('contactTrainer.html.twig',
            ['user' => $user,]);
    }





}
