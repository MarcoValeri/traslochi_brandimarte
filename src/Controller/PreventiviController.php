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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('privacy_authorization', CheckboxType::class, [
                'label' => 'Autorizzo Traslochi Brandimarte Srl al trattamento dei miei dati personali per attività promozionali, pubblicitarie e di marketing dei propri prodotti e servizi',
                'required' => true
            ])
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
                    'label' => 'Telefono *',
                    'required' => true,
                    'invalid_message' => 'Numero di telefono non valido',
                    'constraints' =>
                        [
                            new Length([
                                'min' => 5,
                                'max' => 20,
                                'minMessage' => 'Numero di telefono troppo corto',
                            'maxMessage' => 'Numero di telefono troppo lungo'
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
            ->add('start_address', TextType::class,
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
            ->add('start_city', TextType::class,
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
            ->add('start_cap', NumberType::class,
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
            ->add('start_floor', NumberType::class,
                [
                    'label' => 'Piano di partenza *',
                    'required' => true,
                    'invalid_message' => 'Errore: il campo non è valido',
                    'constraints' =>
                    [
                        new Length([
                            'min' => 1,
                            'max' => 3
                        ]),
                        new Regex([
                            'pattern' => '/[0-9]/',
                            'message' => 'Errore: insirire solo numeri'
                            ])
                    ]
                ])
            ->add('start_lift', ChoiceType::class, [
                'label' => 'Ascensore (partenza) *',
                'required' => true,
                'invalid_message' => 'Errore: cambo obbligatorio',
                'choices' => [
                    '' => '',
                    'Sì' => true,
                    'No' => false
                ],
            ])
            ->add('end_address', TextType::class,
                [
                    'label' => 'Indirizzo di arrivo *',
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
            ->add('end_city', TextType::class,
                [
                    'label' => 'Città di arrivo *',
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
            ->add('end_cap', NumberType::class,
                [
                    'label' => 'CAP di arrivo *',
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
            ->add('end_floor', NumberType::class,
                [
                    'label' => 'Piano di arrivo *',
                    'required' => true,
                    'invalid_message' => 'Errore: il campo non è valido',
                    'constraints' =>
                    [
                        new Length([
                            'min' => 1,
                            'max' => 3
                        ]),
                        new Regex([
                            'pattern' => '/[0-9]/',
                            'message' => 'Errore: insirire solo numeri'
                            ])
                    ]
                ])
            ->add('end_lift', ChoiceType::class, [
                'label' => 'Ascensore (arrivo) *',
                'required' => true,
                'invalid_message' => 'Errore: cambo obbligatorio',
                'choices' => [
                    '' => '',
                    'Sì' => true,
                    'No' => false
                ],
            ])
            ->add('deposit', ChoiceType::class, [
                'label' => 'Il trasloco prevede un periodo di deposito? *',
                'required' => true,
                'invalid_message' => 'Errore: cambo obbligatorio',
                'choices' => [
                    '' => '',
                    'Sì' => true,
                    'No' => false
                ],
            ])
            ->add('entrance', CheckboxType::class, [
                'label' => 'Ingresso',
                'required' => false
            ])
            ->add('corridor', CheckboxType::class, [
                'label' => 'Corridoio',
                'required' => false
            ])
            ->add('kitchen', CheckboxType::class, [
                'label' => 'Cucina',
                'required' => false
            ])
            ->add('dinning_room', CheckboxType::class, [
                'label' => 'Camera da pranzo',
                'required' => false
            ])
            ->add('lounge', CheckboxType::class, [
                'label' => 'Salone',
                'required' => false
            ])
            ->add('bedroom', CheckboxType::class, [
                'label' => 'Camera da letto',
                'required' => false
            ])
            ->add('guest_room', CheckboxType::class, [
                'label' => 'Camera degli ospiti',
                'required' => false
            ])
            ->add('kids_room', CheckboxType::class, [
                'label' => 'Camera dei ragazzi',
                'required' => false
            ])
            ->add('kids_room_two', CheckboxType::class, [
                'label' => 'Seconda Camera dei ragazzi',
                'required' => false
            ])
            ->add('kids_room_three', CheckboxType::class, [
                'label' => 'Terza Camera dei ragazzi',
                'required' => false
            ])
            ->add('other_room', CheckboxType::class, [
                'label' => 'Altra camera',
                'required' => false
            ])
            ->add('bathroom', CheckboxType::class, [
                'label' => 'Bagno',
                'required' => false
            ])
            ->add('bathroom_two', CheckboxType::class, [
                'label' => 'Secondo Bagno',
                'required' => false
            ])
            ->add('study', CheckboxType::class, [
                'label' => 'Studio',
                'required' => false
            ])
            ->add('office', CheckboxType::class, [
                'label' => 'Ufficio',
                'required' => false
            ])
            ->add('canteen', CheckboxType::class, [
                'label' => 'Cantina',
                'required' => false
            ])
            ->add('terrace', CheckboxType::class, [
                'label' => 'Terrazzo',
                'required' => false
            ])
            ->add('terrace_two', CheckboxType::class, [
                'label' => 'Secondo Terrazzo',
                'required' => false
            ])
            ->add('terrace_three', CheckboxType::class, [
                'label' => 'Terzo Terrazzo',
                'required' => false
            ])
            ->add('balcony', CheckboxType::class, [
                'label' => 'Balcone',
                'required' => false
            ])
            ->add('balcony_two', CheckboxType::class, [
                'label' => 'Secondo Balcone',
                'required' => false
            ])
            ->add('balcony_three', CheckboxType::class, [
                'label' => 'Terzo Balcone',
                'required' => false
            ])
            ->add('garage', CheckboxType::class, [
                'label' => 'Garage',
                'required' => false
            ])
            ->add('box', CheckboxType::class, [
                'label' => 'Box',
                'required' => false
            ])
            ->add('external', CheckboxType::class, [
                'label' => 'Esterni',
                'required' => false
            ])
            ->add('message', TextareaType::class,
                [
                'label' => 'Note del cliente',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Un ultimo sforzo: più dettagliate saranno le informazioni che ci fornisci, più preciso sarà il tuo preventivo personalizzato gratuito'
                ],
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
            ->add('privacy_policy', CheckboxType::class, [
                'label' => "Dichiaro di aver preso visione dell'Informativa ai sensi del Decreto Legislativo 196/2003 e del Regolamento (UE) 2016/679 del Parlamento Europeo e del Consiglio del 27 Aprile 2016 (GDPR)",
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Invia il tuo preventivo'
            ])
            ->getForm();
            
            $form_quote->handleRequest($request);

            if ($form_quote->isSubmitted() && $form_quote->isValid()) {

                /*
                * Set and send email to the owner with the data
                * of the form
                */
                $name = $form_quote->get('name')->getData();
                $surname = $form_quote->get('surname')->getData();
                $phone = $form_quote->get('telephone')->getData();
                $email = $form_quote->get('email')->getData();

                $start_address = $form_quote->get('start_address')->getData();
                $start_city = $form_quote->get('start_city')->getData();
                $start_cap = $form_quote->get('start_cap')->getData();
                $start_floor = $form_quote->get('start_floor')->getData();
                $start_lift = $form_quote->get('start_lift')->getData();
                $start_lift === true ? $start_lift = "Sì" : $start_lift = "No";

                $end_address = $form_quote->get('end_address')->getData();
                $end_city = $form_quote->get('end_city')->getData();
                $end_cap = $form_quote->get('end_cap')->getData();
                $end_floor = $form_quote->get('end_floor')->getData();
                $end_lift = $form_quote->get('end_lift')->getData();
                $end_lift === true ? $end_lift = "Sì" : $end_lift = "No";

                $deposit = $form_quote->get('deposit')->getData();
                $deposit === true ? $deposit = "Sì" : $deposit = "No";

                /* 
                * Create array and save inside the following rooms if
                * they exist
                */
                $rooms = array();

                
                $entrance = $form_quote->get('entrance')->getData();
                $entrance === true ? $entrance = "Ingresso" : $entrance = "";
                $entrance !== "" ? array_push($rooms, $entrance) : "";

                $corridor = $form_quote->get('corridor')->getData();
                $corridor === true ? $corridor = "Corridoio" : $corridor = "";
                $corridor !== "" ? array_push($rooms, $corridor) : "";

                $kitchen = $form_quote->get('kitchen')->getData();
                $kitchen === true ? $kitchen = "Cucina" : $kitchen = "";
                $kitchen !== "" ? array_push($rooms, $kitchen) : "";

                $dinning_room = $form_quote->get('dinning_room')->getData();
                $dinning_room === true ? $dinning_room = "Camera da pranzo" : $dinning_room = "";
                $dinning_room !== "" ? array_push($rooms, $dinning_room) : "";

                $lounge = $form_quote->get('lounge')->getData();
                $lounge === true ? $lounge = "Salone" : $lounge = "";
                $lounge !== "" ? array_push($rooms, $lounge) : "";

                $bedroom = $form_quote->get('bedroom')->getData();
                $bedroom === true ? $bedroom = "Camera da letto" : $bedroom = "";
                $bedroom !== "" ? array_push($rooms, $bedroom) : "";

                $guest_room = $form_quote->get('guest_room')->getData();
                $guest_room === true ? $guest_room = "Camera degli ospiti" : $guest_room = "";
                $guest_room !== "" ? array_push($rooms, $guest_room) : "";

                $kids_room = $form_quote->get('kids_room')->getData();
                $kids_room === true ? $kids_room = "Camera dei ragazzi" : $kids_room = "";
                $kids_room !== "" ? array_push($rooms, $kids_room) : "";

                $kids_room_two = $form_quote->get('kids_room_two')->getData();
                $kids_room_two === true ? $kids_room_two = "Seconda camera dei ragazzi" : $kids_room_two = "";
                $kids_room_two !== "" ? array_push($rooms, $kids_room_two) : "";

                $kids_room_three = $form_quote->get('kids_room_three')->getData();
                $kids_room_three === true ? $kids_room_three = "Terza camera dei ragazzi" : $kids_room_three = "";
                $kids_room_three !== "" ? array_push($rooms, $kids_room_three) : "";

                $other_room = $form_quote->get('other_room')->getData();
                $other_room === true ? $other_room = "Altra stanza" : $other_room = "";
                $other_room !== "" ? array_push($rooms, $other_room) : "";

                $bathroom = $form_quote->get('bathroom')->getData();
                $bathroom === true ? $bathroom = "Bagno" : $bathroom = "";
                $bathroom !== "" ? array_push($rooms, $bathroom) : "";

                $bathroom_two = $form_quote->get('bathroom_two')->getData();
                $bathroom_two === true ? $bathroom_two = "Secondo bagno" : $bathroom_two = "";
                $bathroom_two !== "" ? array_push($rooms, $bathroom_two) : "";

                $study = $form_quote->get('study')->getData();
                $study === true ? $study = "Studio" : $study = "";
                $study !== "" ? array_push($rooms, $study) : "";

                $office = $form_quote->get('office')->getData();
                $office === true ? $office = "Ufficio" : $office = "";
                $office !== "" ? array_push($rooms, $office) : "";

                $canteen = $form_quote->get('canteen')->getData();
                $canteen === true ? $canteen = "Cantina" : $canteen = "";
                $canteen !== "" ? array_push($rooms, $canteen) : "";

                $terrace = $form_quote->get('terrace')->getData();
                $terrace === true ? $terrace = "Terrazzo" : $terrace = "";
                $terrace !== "" ? array_push($rooms, $terrace) : "";

                $terrace_two = $form_quote->get('terrace_two')->getData();
                $terrace_two === true ? $terrace_two = "Secondo terrazzo" : $terrace_two = "";
                $terrace_two !== "" ? array_push($rooms, $terrace_two) : "";

                $terrace_three = $form_quote->get('terrace_three')->getData();
                $terrace_three === true ? $terrace_three = "Terzo terrazzo" : $terrace_three = "";
                $terrace_three !== "" ? array_push($rooms, $terrace_three) : "";

                $balcony = $form_quote->get('balcony')->getData();
                $balcony === true ? $balcony = "Balcone" : $balcony = "";
                $balcony !== "" ? array_push($rooms, $balcony) : "";

                $balcony_two = $form_quote->get('balcony_two')->getData();
                $balcony_two === true ? $balcony_two = "Secondo balcone" : $balcony_two = "";
                $balcony_two !== "" ? array_push($rooms, $balcony_two) : "";

                $balcony_three = $form_quote->get('balcony_three')->getData();
                $balcony_three === true ? $balcony_three = "Terzo balcone" : $balcony_three = "";
                $balcony_three !== "" ? array_push($rooms, $balcony_three) : "";

                $garage = $form_quote->get('garage')->getData();
                $garage === true ? $garage = "Garage" : $garage = "";
                $garage !== "" ? array_push($rooms, $garage) : "";

                $box = $form_quote->get('box')->getData();
                $box === true ? $box = "Box" : $box = "";
                $box !== "" ? array_push($rooms, $box) : "";

                $external = $form_quote->get('external')->getData();
                $external === true ? $external = "Esterni" : $external = "";
                $external !== "" ? array_push($rooms, $external) : "";

                $message = $form_quote->get('message')->getData();
                strlen($message) < 5 ? $message = "nessuna nota" : "";

                /*
                * Set email message
                */
                $email_message = "Preventivo online Traslochi Brandimarte \n";
                $email_message .= "\n";
                $email_message .= "Preventivo richiesto da: \n";
                $email_message .= "Nome: $name \n";
                $email_message .= "Cognome: $surname \n";
                $email_message .= "Telefono: $phone \n";
                $email_message .= "Email: $email \n";
                $email_message .= "\n";

                $email_message .= "Indirizzo di partenza: \n";
                $email_message .= "$start_address \n";
                $email_message .= "Città $start_city \n";
                $email_message .= "CAP: $start_cap \n";
                $email_message .= "Piano: $start_floor \n";
                $email_message .= "Ascensore: $start_lift \n";
                $email_message .= "\n";

                $email_message .= "Indirizzo di arrivo: \n";
                $email_message .= "$end_address \n";
                $email_message .= "Città $end_city \n";
                $email_message .= "CAP: $end_cap \n";
                $email_message .= "Piano: $end_floor \n";
                $email_message .= "Ascensore: $end_lift \n";
                $email_message .= "\n";

                $email_message .= "Necessità di deposito: $deposit \n";
                $email_message .= "\n";

                $email_message .= "Camere selezionate: \n";

                foreach ($rooms as $room) {
                    $email_message .= "- $room \n";
                }

                $email_message .= "\n";

                $email_message .= "Note del cliente: \n";
                $email_message .= $message;

                /*
                * Format email message and
                * send the email
                */
                $email_message = wordwrap($email_message, 100);

                mail("info@marcovaleri.net", "Preventivo online Traslochi Brandimarte", $email_message);

                /*
                * Set email message for the use and send it
                * by the email address provided by the form
                */
                $user_email_message = "Gentile $name, \n";
                $user_email_message .= "\n";
                $user_email_message .= "Grazie per la tua fiducia che ci hai dimostrato. \n";
                $user_email_message .= "\n";
                $user_email_message .= "So quando sia difficile organizzare e trovare la giusta ditta per un trasloco, \n";
                $user_email_message .= "parola di chi lavora in questo settore da più di 20 anni. \n";
                $user_email_message .= "\n";
                $user_email_message .= "Ho ricevuto personalmente la tua richiesta di preventivo, cercherò di eleborarla al meglio che posso ";
                $user_email_message .= "per adattarla alle tue esigenze e darti il miglior rapporto qualità prezzo per il tuo prossimo trasloco. \n";
                $user_email_message .= "\n";
                $user_email_message .= "Come d'accordo, riceverai il tuo preventivo gratuito e senza impegno entro e non oltre le 24 ore.\n";
                $user_email_message .= "\n";
                $user_email_message .= "Grazie per la fiducia che hai dimostrato fino ad ora nei nostri servizi\n";
                $user_email_message .= "\n";
                $user_email_message .= "Andrea Brandimarte";

                $user_email_message = wordwrap($user_email_message, 100);

                mail($email, "Traslochi Brandimarte richiesta preventivo online gratuito", $user_email_message);

                return $this->redirectToRoute('app_preventivo_online_conferma');

            }
            

        return $this->render('pages/preventivo-online.html.twig', [
            'form_quote' => $form_quote->createView()
        ]);

    }

    /**
     * @Route("/preventivo-online-conferma", name="app_preventivo_online_conferma")
     */
    public function preventivo_online_conferma() {
        return $this->render('pages/preventivo-online-conferma.html.twig');
    }

}