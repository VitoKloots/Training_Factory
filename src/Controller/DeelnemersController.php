<?php


namespace App\Controller;


use App\Entity\Training;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TrainingType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DeelnemersController extends AbstractController
{
    /**
     * @Route("/profiel/edit", name="profiel_edit", methods={"GET","POST"})
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $password = $user->getPassword();
        $form = $this->createForm(UserType::class, $user);
        $form->remove('Plainpassword');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setPassword($password);
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
}