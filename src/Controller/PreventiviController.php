<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class PreventiviController extends AbstractController {

    /**
     * @Route("/preventivi", name="app_preventivi")
     */
    public function preventivi() {

        return $this->render('pages/preventivi.html.twig');

    }

    /**
     * @Route("/preventivo-online", name="app_preventivo_online")
     */
    public function preventivo_online(Request $request) {

        /*
        * Create a form that allows users to make a quote
        * and recive it by email
        * If the form is submitted also the owner recives a
        * email with the data of the user
        */
        $form_quote = $this->createFormBuilder([])
            ->add('name', TextType::class,
                [
                    'label' => 'Nome *',
                    'required' => true,
                    'constraints' =>
                    [
                        new Length([
                            'min' => 2,
                            'max' => 20,
                            'minMessage' => 'Nome è troppo corto, dovrebbe essere di 2 caratteri o più lungo',
                            'maxMessage' => 'Nome è troppo lungo, dovrebbe essere di massimo 20 caratteri'
                        ]),
                        new Regex([
                            'pattern' => '/[a-zA-Z]/',
                            'message' => 'Errore: inserire solo lettere'
                        ])
                    ]
                ])
            ->add('surname', TextType::class,
                [
                    'label' => 'Cognome *',
                    'required' => true,
                    'constraints' =>
                    [
                        new Length([
                            'min' => 2,
                            'max' => 20,
                            'minMessage' => 'Cognome è troppo corto, dovrebbe essere di 2 caratteri o più lungo',
                            'maxMessage' => 'Cognome è troppo lungo, dovrebbe essere di massimo 20 caratteri'
                        ]),
                        new Regex([
                            'pattern' => '/[a-zA-Z]/',
                            'message' => 'Errore: inserire solo lettere'
                        ])
                    ]
                ])
            ->add('telephone', NumberType::class,
                [
                    'label' => 'Telefono (non obbligatorio)',
                    'required' => false,
                    'invalid_message' => 'Numero di telefono non valido',
                    'constraints' =>
                        [
                            new Length([
                                'min' => 5,
                                'max' => 20
                            ]),
                            new Regex([
                                'pattern' => '/[0-9]/',
                                'message' => 'Errore: insirire solo numeri e/o il + per i prefissi internazionali'
                            ])
                    ]
                ])
            ->add('email', EmailType::class,
                [
                    'label' => 'Email *',
                    'required' => true,
                    'invalid_message' => 'Errore: indirizzo email non valido'
                ])
            ->add('start-address', TextType::class,
                [
                    'label' => 'Indirizzo di partenza *',
                    'required' => true,
                    'constraints' =>
                    [
                        new Length([
                            'min' => 2,
                            'max' => 100,
                            'minMessage' => 'Errore: il campo è troppo corto, dovrebbe essere di 2 caratteri o più lungo',
                            'maxMessage' => 'Errore: il campo è troppo lungo, dovrebbe essere di massimo 20 caratteri'
                        ]),
                        new Regex([
                            'pattern' => '/[a-zA-Z]/',
                            'message' => 'Errore: inserire solo lettere'
                        ])
                    ]
                ])
            ->add('start-city', TextType::class,
                [
                    'label' => 'Città di partenza *',
                    'required' => true,
                    'constraints' =>
                    [
                        new Length([
                            'min' => 2,
                            'max' => 20,
                            'minMessage' => 'Errore: il campo è troppo corto, dovrebbe essere di 2 caratteri o più lungo',
                            'maxMessage' => 'Errore: il campo è troppo lungo, dovrebbe essere di massimo 20 caratteri'
                        ]),
                        new Regex([
                            'pattern' => '/[a-zA-Z]/',
                            'message' => 'Errore: inserire solo lettere'
                        ])
                    ]
                ])
            ->add('start-cap', NumberType::class,
                [
                    'label' => 'CAP di partenza *',
                    'required' => true,
                    'invalid_message' => 'Errore: il campo non è valido',
                    'constraints' =>
                    [
                        new Length([
                            'min' => 2,
                            'max' => 10
                        ]),
                        new Regex([
                            'pattern' => '/[0-9]/',
                            'message' => 'Errore: insirire solo numeri'
                            ])
                    ]
                ])
            ->getForm();
            
            $form_quote->handleRequest($request);
            

        return $this->render('pages/preventivo-online.html.twig', [
            'form_quote' => $form_quote->createView()
        ]);

    }

}