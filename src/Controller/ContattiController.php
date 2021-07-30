<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
            ->add('name', TextType::class, ['label' => 'Nome', 'required' => true])
            ->add('surname', TextType::class, ['label' => 'Cognome', 'required' => true])
            ->add('email', EmailType::class, ['label' => 'Email', 'required' => true])
            ->add('message', TextareaType::class, ['label' => 'Messaggio', 'required' => true])
            ->add('submit', SubmitType::class, ['label' => 'Invia'])
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