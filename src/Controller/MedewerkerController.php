<?php


namespace App\Controller;


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


class MedewerkerController
{

//    public function homepage()
//    {
//        $trainingen = $this->getDoctrine()->getRepository('App:Training')->findAll();
//        return $this->render('bezoeker.html.twig', [
//            'trainingen' => $trainingen
//        ]);
//    }


}