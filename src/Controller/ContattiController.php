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

class ContattiController extends AbstractController {

    /**
     * @Route("/contatti", name="app_contatti")
     */
    public function contatti(Request $request) {

        /*
        * Create a contact form that allows
        * user to contact the owener by the 
        * form
        * If the fields are valid, the owner
        * recive an email with the data and
        * the request of the user
        */
        $form_contact = $this->createFormBuilder([])
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
                                'message' => 'Errore: insirire solo lettere'
                            ])
                        ]
                    ])
            ->add('email', EmailType::class,
                [
                    'label' => 'Email *',
                    'required' => true,
                    'invalid_message' => 'Errore: indirizzo email non valido'
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
            ->add('message', TextareaType::class,
                [
                    'label' => 'Messaggio *',
                    'required' => true,
                    'constraints' =>
                        [
                            new Length([
                                'min' => 10,
                                'max' => 500,
                                'minMessage' => 'Messaggio è troppo corto, dovrebbe essere di 10 caratteri o più lungo',
                                'maxMessage' => 'Cognome è troppo lungo, dovrebbe essere di massimo 500 caratteri'
                                ])
                        ]
                    ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'Invia'
                    ])
            ->getForm();

        $form_contact->handleRequest($request);

        if ($form_contact->isSubmitted() && $form_contact->isValid()) {

            $name = $form_contact->get('name')->getData();
            $surname = $form_contact->get('surname')->getData();
            $email = $form_contact->get('email')->getData();
            $message = $form_contact->get('message')->getData();

            $email_message = "Contatti Traslochi Brandimarte \n";
            $email_message .= "Messaggio inviato da: \n";
            $email_message .= "Nome: $name \n";
            $email_message .= "Cognome: $surname \n";
            $email_message .= "Email: $email \n";
            $email_message .= "Messaggio: \n";
            $email_message .= $message;

            $email_message = wordwrap($email_message, 70);

            mail("info@marcovaleri.net", "Contatti Traslochi Brandimarte", $email_message);

        }

        return $this->render('pages/contatti.html.twig', [
            'form_contact' => $form_contact->createView()
        ]);
    }

}