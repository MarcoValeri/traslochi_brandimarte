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
            ->add('start-floor', NumberType::class,
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
            ->add('start-lift', ChoiceType::class, [
                'label' => 'Ascensore (partenza) *',
                'required' => true,
                'invalid_message' => 'Errore: cambo obbligatorio',
                'choices' => [
                    '' => null,
                    'Sì' => true,
                    'No' => false
                ],
            ])
            ->add('end-address', TextType::class,
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
            ->add('end-city', TextType::class,
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
            ->add('end-cap', NumberType::class,
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
            ->add('end-floor', NumberType::class,
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
            ->add('end-lift', ChoiceType::class, [
                'label' => 'Ascensore (arrivo) *',
                'required' => true,
                'invalid_message' => 'Errore: cambo obbligatorio',
                'choices' => [
                    '' => null,
                    'Sì' => true,
                    'No' => false
                ],
            ])
            ->add('deposit', ChoiceType::class, [
                'label' => 'Il trasloco prevede un periodo di deposito? *',
                'required' => true,
                'invalid_message' => 'Errore: cambo obbligatorio',
                'choices' => [
                    '' => null,
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
            ->add('corridor_two', CheckboxType::class, [
                'label' => 'Secondo corridoio',
                'required' => false
            ])
            ->add('corridor_three', CheckboxType::class, [
                'label' => 'Terzo corridoio',
                'required' => false
            ])
            ->add('kitchen', CheckboxType::class, [
                'label' => 'Cucina',
                'required' => false
            ])
            ->add('kitchen_two', CheckboxType::class, [
                'label' => 'Seconda Cucina',
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
            ->add('lounge_two', CheckboxType::class, [
                'label' => 'Secondo Salone',
                'required' => false
            ])
            ->add('lounge_three', CheckboxType::class, [
                'label' => 'Terzo Salone',
                'required' => false
            ])
            ->add('bedroom', CheckboxType::class, [
                'label' => 'Camera da letto',
                'required' => false
            ])
            ->add('bedroom_two', CheckboxType::class, [
                'label' => 'Seconda Camera da letto',
                'required' => false
            ])
            ->add('bedroom_three', CheckboxType::class, [
                'label' => 'Terza Camera da letto',
                'required' => false
            ])
            ->add('bedroom_three', CheckboxType::class, [
                'label' => 'Terza Camera da letto',
                'required' => false
            ])
            ->add('guest_room', CheckboxType::class, [
                'label' => 'Camera degli ospiti',
                'required' => false
            ])
            ->add('guest_room_two', CheckboxType::class, [
                'label' => 'Terza Camera degli ospiti',
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
            ->add('other_room_two', CheckboxType::class, [
                'label' => 'Seconda altra camera',
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
            ->add('bathroom_three', CheckboxType::class, [
                'label' => 'Terzo Bagno',
                'required' => false
            ])
            ->add('study', CheckboxType::class, [
                'label' => 'Studio',
                'required' => false
            ])
            ->add('study_two', CheckboxType::class, [
                'label' => 'Secondo Studio',
                'required' => false
            ])
            ->add('study_three', CheckboxType::class, [
                'label' => 'Terzo Studio',
                'required' => false
            ])
            ->add('study_four', CheckboxType::class, [
                'label' => 'Quarto Studio',
                'required' => false
            ])
            ->add('study_five', CheckboxType::class, [
                'label' => 'Qinto Studio',
                'required' => false
            ])
            ->add('office', CheckboxType::class, [
                'label' => 'Ufficio',
                'required' => false
            ])
            ->add('office_two', CheckboxType::class, [
                'label' => 'Secondo Ufficio',
                'required' => false
            ])
            ->add('office_three', CheckboxType::class, [
                'label' => 'Terzo Ufficio',
                'required' => false
            ])
            ->add('office_four', CheckboxType::class, [
                'label' => 'Quarto Ufficio',
                'required' => false
            ])
            ->add('office_five', CheckboxType::class, [
                'label' => 'Quinto Ufficio',
                'required' => false
            ])
            ->add('canteen', CheckboxType::class, [
                'label' => 'Cantina',
                'required' => false
            ])
            ->add('canteen_two', CheckboxType::class, [
                'label' => 'Seconda Cantina',
                'required' => false
            ])
            ->add('canteen_three', CheckboxType::class, [
                'label' => 'Terza Cantina',
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
            ->add('terrace_four', CheckboxType::class, [
                'label' => 'Quarto Terrazzo',
                'required' => false
            ])
            ->add('terrace_five', CheckboxType::class, [
                'label' => 'Quinto Terrazzo',
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
            ->add('balcony_four', CheckboxType::class, [
                'label' => 'Quarto Balcone',
                'required' => false
            ])
            ->add('balcony_five', CheckboxType::class, [
                'label' => 'Quinto Balcone',
                'required' => false
            ])
            ->add('garage', CheckboxType::class, [
                'label' => 'Garage',
                'required' => false
            ])
            ->add('garage_two', CheckboxType::class, [
                'label' => 'Secondo Garage',
                'required' => false
            ])
            ->add('privacy_policy', CheckboxType::class, [
                'label' => "Dichiaro di aver preso visione dell'Informativa ai sensi del Decreto Legislativo 196/2003 e del Regolamento (UE) 2016/679 del Parlamento Europeo e del Consiglio del 27 Aprile 2016 (GDPR)",
                'required' => true
            ])
            ->add('privacy_policy_two', CheckboxType::class, [
                'label' => 'Autorizzo Traslochi Brandimarte SRL al trattamento dei miei dati personali per attività promozionali, pubblicitarie e di marketing dei propri prodotti e servizi',
                'required' => true
            ])
            ->add('message', TextareaType::class,
                [
                'label' => 'Informazioni aggiuntive',
                'required' => false,
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
            ->add('submit', SubmitType::class, [
                'label' => 'Invia'
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
                $email = $form_quote->get('name')->getData();

                $start_address = $form_quote->get('start-address')->getData();
                $start_city = $form_quote->get('start-city')->getData();
                $start_cap = $form_quote->get('start-cap')->getData();
                $start_floor = $form_quote->get('start-floor')->getData();
                $start_lift = $form_quote->get('start-lift')->getData();

                $end_address = $form_quote->get('end-address')->getData();
                $end_city = $form_quote->get('end-city')->getData();
                $end_cap = $form_quote->get('end-cap')->getData();
                $end_floor = $form_quote->get('end-floor')->getData();
                $end_lift = $form_quote->get('end-lift')->getData();

                $deposit = $form_quote->get('deposit')->getData();

                $entrance = $form_quote->get('entrance')->getData();
                $entrance === true ? $entrance = "Corridoio" : $entrance = "";


            }
            

        return $this->render('pages/preventivo-online.html.twig', [
            'form_quote' => $form_quote->createView()
        ]);

    }

}