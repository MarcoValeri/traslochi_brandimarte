<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/servizi", name="app_servizi")
     */
    public function servizi() {
        return $this->render('pages/servizi.html.twig');
    }

}