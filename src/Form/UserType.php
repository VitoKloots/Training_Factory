<?php

namespace App\Form;

use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('voornaam', TextType::class)
            ->add('tussenvoegsel', TextType::class,[
                'required' => false,
            ])
            ->add('achternaam', TextType::class)
            ->add('geboortedatum', BirthdayType::class)
            ->add('geslacht', TextType::class)
            ->add('Plainpassword', PasswordType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Wachtwoord'
            ])
            ->add('Opslaan', SubmitType::class);
    }

}