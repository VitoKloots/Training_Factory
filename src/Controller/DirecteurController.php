<?php

// src/Controller/TaskController.php
namespace App\Controller;

use App\Entity\Training;
use App\Entity\User;
use App\Form\TrainingType;
use App\Form\UserType;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Require ROLE_ADMIN for *every* controller method in this class
 * .
 * @Route("/admin", name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */
class DirecteurController extends AbstractController
{
    /**
     * @Route("/", name="training_index", methods={"GET"})
     */
    public function index(TrainingRepository $trainingRepository): Response
    {
        return $this->render('admin/training/index.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/instructeurOverzicht", name="instructeur_index")
     */
    public function instructeurIndexFunction()
    {
        $instructeur = $this->getDoctrine()->getRepository(User::class)->findByRole('ROLE_INSTRUCTOR');
        return $this->render('admin/medewerker/instructeurOverzicht.html.twig', [
            'instructeurs' => $instructeur
        ]);
    }

    /**
     * @Route("/ledenOverzicht", name="leden_index")
     */
    public function deelnemerIndexFunction()
    {
        $leden = $this->getDoctrine()->getRepository(User::class)->findByRole('ROLE_USER');
        return $this->render('admin/deelnemer/ledenOverzicht.html.twig', [
            'lid' => $leden
        ]);
    }

    /**
     * @Route("/training/new", name="training_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($training);
            $entityManager->flush();

            return $this->redirectToRoute('aanbod');
        }

        return $this->render('admin/training/new.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
            'title' => 'Training maken'
        ]);
    }

    /**
     * @Route("/training/{id}", name="training_show", methods={"GET"})
     */
    public function show(Training $training): Response
    {
        return $this->render('admin/training/show.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("/training/{id}/edit", name="training_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Training $training): Response
    {
        //$training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($training);
            $entityManager->flush();

            return $this->redirectToRoute('aanbod');
        }

        return $this->render('admin/training/new.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
            'title' => 'Training wijzigen'
        ]);
    }

    /**
     * @Route("/training/{id}", name="training_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Training $training): Response
    {
        if ($this->isCsrfTokenValid('delete'.$training->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($training);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_training_index');
    }


    /**
     * @Route("/registrerenInstructeur", name="registreren_Instructeur")
     */
    public function registerNewMemberAction(Request $request,
                                            UserPasswordEncoderInterface $passwordEncoder)
    {
        $newMember = new User();
        $form= $this->createForm(UserType::class, $newMember);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $newMember=$form->getData();
            $newMember->setPassword($passwordEncoder->encodePassword($newMember,$form->get('Plainpassword')->getData()));
            $newMember->setRoles(['ROLE_INSTRUCTOR']);

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($newMember);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('bezoeker/registreren.html.twig', [
            'form'=>$form->createView(),
            'title' => 'Instructeur Registreren'
        ]);
    }

    /**
     * @Route("/user/{id}", name="user_delete", methods={"POST"})
     */
    public function ledenDelete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_instructeur_index');
    }

    /**
     * @Route("/user/editUser/{id}", name="edit_user", methods={"GET","POST"})
     */
    public function edituserAction(Request $request, User $user)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->remove('Plainpassword');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('bezoeker/registreren.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'title' => 'Profiel bewerken',
            ''
        ]);
    }

    public function adminDashboard()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    }
}
