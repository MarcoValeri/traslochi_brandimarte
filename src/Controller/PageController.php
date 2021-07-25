<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController {

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage() {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @Route("/chi-siamo", name="app_chi_siamo")
     */
    public function chiSiamo() {
        return $this->render('pages/chi-siamo.html.twig');
    }

    /**
     * @Route("/preventivi", name="app_preventivi")
     */
    public function preventivi() {
        return $this->render('pages/preventivi.html.twig');
    }

    /**
     * @Route("/servizi", name="app_servizi")
     */
    public function servizi() {
        return $this->render('pages/servizi.html.twig');
    }

    /**
     * @Route("/contatti", name="app_contatti")
     */
    public function contatti() {
        return $this->render('pages/contatti.html.twig');
    }

}