<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PreventiviController extends AbstractController {

    /**
     * @Route("/preventivi", name="app_preventivi")
     */
    public function preventivi(Request $request) {

        /*
        * Create a form that allows users to make a quote
        * and recive it by email
        * If the form is submitted also the owner recives a
        * email with the data of the user
        */
        $form_quote = $this->createFormBuilder([]);

        return $this->render('pages/preventivi.html.twig');

    }

}