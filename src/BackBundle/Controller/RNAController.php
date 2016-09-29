<?php

namespace BackBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RNAController extends Controller {
    
    /**
     * @Route("/rna", name="rna")
     */
    public function indexAction() {
        $lotes = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->getPorUsuario($this->getUser()->getId());
        return $this->render('BackBundle:RNA:index.html.twig', array('lotes' => $lotes));
    }
    
    /**
     * @Route("/get_siembras", name="get_siembras", options={"expose"=true})
     */
    public function siembrasAction() {
        $em = $this->getDoctrine()->getManager();
        $siembras = $em->getRepository('ApiBundle:Siembra')->getPorUsuario($this->getUser()->getId());

        return new Response(json_encode($siembras));
    }
    
    /**
     * @Route("/get_lotes", name="get_lotes", options={"expose"=true})
     */
    public function lotesAction() {
        $em = $this->getDoctrine()->getManager();
        $lotes = $em->getRepository('ApiBundle:Lote')->getPorUsuario($this->getUser()->getId());

        return new Response(json_encode($lotes));
    }
}
