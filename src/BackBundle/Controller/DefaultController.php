<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction() {
        return $this->render('BackBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/mayor_rinde", name="mayor_rinde", options={"expose"=true})
     */
    public function get5MayorRindeAction() {
        return new Response(json_encode($this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->get5MayorRinde($this->getUser()->getId())));
    }

    /**
     * @Route("/menor_rinde", name="menor_rinde", options={"expose"=true})
     */
    public function get5MenorRindeAction() {
        return new Response(json_encode($this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->get5MenorRinde($this->getUser()->getId())));
    }

    /**
     * @Route("/mayor_beneficio", name="mayor_beneficio", options={"expose"=true})
     */
    public function get5MayorBeneficioAction() {
        return new Response(json_encode($this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->get5MayorBeneficio($this->getUser()->getId())));
    }

    /**
     * @Route("/menor_beneficio", name="menor_beneficio", options={"expose"=true})
     */
    public function get5MenorBeneficioAction() {
        return new Response(json_encode($this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->get5MenorBeneficio($this->getUser()->getId())));
    }

    /**
     * @Route("/sin_cosechar", name="sin_cosechar", options={"expose"=true})
     */
    public function getSinCosecharAction() {
        return new Response(json_encode($this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->getSinCosechar($this->getUser()->getId())));
    }

    /**
     * @Route("/perdidas", name="perdidas", options={"expose"=true})
     */
    public function getPerdidasAction() {
        return new Response(json_encode($this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->getPerdidas($this->getUser()->getId())));
    }

    /**
     * @Route("/terreno_cultivado", name="terreno_cultivado", options={"expose"=true})
     */
    public function getTerrenoCultivadoAction() {
        $array = [];
        
        $totales = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->getSueloTotalPorSiembra($this->getUser()->getId());
        $arrayTotales = [];
        foreach($totales as $cultivo) {
            $aux = [];
            $aux["label"] = $cultivo["cultivo"];
            $aux["value"] = (int)$cultivo["cantidad"];       
            $arrayTotales[] = $aux;       
        }
        $array["historico"] = $arrayTotales;
        
        $presentes = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->getSueloPresentePorSiembra($this->getUser()->getId());
        $arrayPresentes = [];
        foreach($presentes as $cultivo) {
            $aux = [];
            $aux["label"] = $cultivo["cultivo"];
            $aux["value"] = (int)$cultivo["cantidad"];       
            $arrayPresentes[] = $aux;    
        }
        $array["actual"] = $arrayPresentes;
        
        return new Response(json_encode($array));
    }
    
    /**
     * @Route("/rinde_promedio_anual", name="rinde_promedio_anual", options={"expose"=true})
     */
    public function getRindePromedioAnualAction() {
        $promedios = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->getRindePromedioAnual($this->getUser()->getId());        
        $array = [];
        $cultivos = [];
        foreach($promedios as $promedio) {
            if(!in_array($promedio["cultivo"], $cultivos))
                $cultivos[] = $promedio["cultivo"];
            
            if(!array_key_exists($promedio["year"], $array)) {
                $array[$promedio["year"]] = [];
                $array[$promedio["year"]]["y"] = $promedio["year"];
            }
                
            $array[$promedio["year"]][$promedio["cultivo"]] = (int)$promedio["cantidad"]; 
        }
        
        $data = array("datos" => [], "cultivos" => $cultivos);
        foreach($array as $x) {
            $data["datos"][] = $x;
        }
        
        return new Response(json_encode($data));
    }
    
    /**
     * @Route("/cosechas_por_lotes", name="cosechas_por_lotes", options={"expose"=true})
     */
    public function getUltimas4PorLoteAction() {
        $datos = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->getUltimas4PorLote($this->getUser()->getId());        
     
        return new Response(json_encode($datos));
    }

}
