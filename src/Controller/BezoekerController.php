<?php


namespace App\Controller;

use App\Entity\Training;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\Migrations\Exception\UnknownMigrationVersion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

//Rendert de base.html page
    public function homepage()
    {
        $trainingen = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('bezoeker.html.twig', [
            'trainingen' => $trainingen
        ]);
    }

    /**
     * @Route("/gedragregels", name="showgedragregels")
     */

    public function regelsAction()
    {
        $trainingen = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('gedragregels.html.twig', [
            'trainingen' => $trainingen
        ]);
    }

    /**
     * @Route("/contact", name="showcontact")
     */

    public function contactAction()
    {
        $trainingen = $this->getDoctrine()->getRepository('App:Training')->findAll();
        return $this->render('details.html.twig', [
            'trainingen' => $trainingen
        ]);
    }


    /**
     * @Route("/training", name="aanbod")
     */
    public function aanbodAction()
    {
        $trainingen = $this->getDoctrine()->getRepository(Training::class)->findAll();
        return $this->render('bezoeker/trainingen.html.twig', [
            'trainingen' => $trainingen,
        ]);
    }

    /**
     * @Route("/registreren", name="registreren")
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
            $newMember->setRoles(['ROLE_USER']);

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($newMember);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('bezoeker/registreren.html.twig', [
            'form'=>$form->createView(),
            'title' => 'Registreren'
            ]);
    }

    public function userDashboard()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    }
}