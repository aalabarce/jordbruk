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
     * @Route("/get_lotes", name="get_lotes", options={"expose"=true})
     */
    public function lotesAction() {
        $lotes = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->getPorUsuario($this->getUser()->getId());
        
        $arrayLotes = [];
        foreach($lotes as $lote) {
            $nuevoLote = [];
            $nuevoLote['id']= $lote->getId();
            $nuevoLote['number']= $lote->getId();
            $nuevoLote['surface']= $lote->getSuperficie();
            $nuevoLote['soil']= $lote->getSuelo()->getNombre();
            $nuevoLote['locality']= $lote->getLocalidad()->getNombre();
            $nuevoLote['province']= $lote->getProvincia()->getNombre();
            
            $arrayLotes[] = $nuevoLote;
        }
        
        return new Response(json_encode($arrayLotes));
    }
    
    /**
     * @Route("/get_siembras", name="get_siembras", options={"expose"=true})
     */
    public function siembrasAction() {
        $siembras = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->findAll();

        $arraySiembras = [];
        foreach($siembras as $siembra) {
            $nuevaSiembra = [];
            $nuevaSiembra["id"] = $siembra->getId();
            $nuevaSiembra["date"] = [];
            $nuevaSiembra["date"]["day"] = $siembra->getFecha()->format("d");
            $nuevaSiembra["date"]["month"] = $siembra->getFecha()->format("m");
            $nuevaSiembra["date"]["year"] = $siembra->getFecha()->format("y");
            $nuevaSiembra["lot"] = $siembra->getLote()->getId();
            $nuevaSiembra["crop"] = $siembra->getCultivo()->getNombre();
            $nuevaSiembra["water"] = $siembra->getAguaRecibida();
            $nuevaSiembra["plowed"] = $siembra->getArado();
            $nuevaSiembra["fertilized"] = $siembra->getFertilizado();
            $nuevaSiembra["fumigated"] = $siembra->getFumigado();
            $nuevaSiembra["cost"] = $siembra->getCosto();
            
            $arraySiembras[] = $nuevaSiembra;
        }
        
        return new Response(json_encode($arraySiembras));
    }
    
    /**
     * @Route("/get_cosechas", name="get_cosechas", options={"expose"=true})
     */
    public function cosechasAction() {
        $cosechas = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->findAll();

        $arrayCosechas = [];
        foreach($cosechas as $cosecha) {;
            $nuevoCosecha = [];
            $nuevoCosecha['id']= $cosecha->getId();
            $nuevoCosecha["date"] = [];
            $nuevoCosecha["date"]["day"] = $cosecha->getFecha()->format("d");
            $nuevoCosecha["date"]["month"] = $cosecha->getFecha()->format("m");
            $nuevoCosecha["date"]["year"] = $cosecha->getFecha()->format("y");
            $nuevoCosecha['sowing']= $cosecha->getSiembra()->getId();
            $nuevoCosecha['average']= $cosecha->getRinde();
            $nuevoCosecha['profit']= $cosecha->getBeneficio();
            
            $arrayCosechas[] = $nuevoCosecha;
        }
        
        return new Response(json_encode($arrayCosechas));
    }
}