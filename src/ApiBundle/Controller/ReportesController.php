<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class ReportesController extends FOSRestController {

    /**
     * @ApiDoc(
     *  description="Cosechas con mayor rinde",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Cosecha", "groups"={"Cosecha"}}
     * )
     * @View(serializerGroups={"Cosecha"})
     * @Get("/mayor_rinde", name="api_mayor_rinde")
     */
    public function get5MayorRindeAction() {
        $cosechas = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->get5MayorRinde($this->getUser()->getId());
        
        return $cosechas;
    }

    /**
     * @ApiDoc(
     *  description="Cosechas con menor rinde",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Cosecha", "groups"={"Cosecha"}}
     * )
     * @View(serializerGroups={"Cosecha"})
     * @Get("/menor_rinde", name="api_menor_rinde")
     */
    public function get5MenorRindeAction() {
        $cosechas = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->get5MenorRinde($this->getUser()->getId());
        
        return $cosechas;
    }

    /**
     * @ApiDoc(
     *  description="Cosechas con mayor beneficio",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Cosecha", "groups"={"Cosecha"}}
     * )
     * @View(serializerGroups={"Cosecha"})
     * @Get("/mayor_beneficio", name="api_mayor_beneficio")
     */
    public function get5MayorBeneficioAction() {
        $cosechas = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->get5MayorBeneficio($this->getUser()->getId());
        
        return $cosechas;
    }

    /**
     * @ApiDoc(
     *  description="Cosechas con menor beneficio",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Cosecha", "groups"={"Cosecha"}}
     * )
     * @View(serializerGroups={"Cosecha"})
     * @Get("/menor_beneficio", name="api_menor_beneficio")
     */
    public function get5MenorBeneficioAction() {
        $cosechas = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->get5MenorBeneficio($this->getUser()->getId());
        
        return $cosechas;
    }

    /**
     * @ApiDoc(
     *  description="Siembras sin cosechar",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Siembra", "groups"={"Siembra"}}
     * )
     * @View(serializerGroups={"Siembra"})
     * @Get("/sin_cosechar", name="sin_cosechar")
     */
    public function getSinCosecharAction() {
        $siembras = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->getSinCosechar($this->getUser()->getId());
        
        return $siembras;
    }

    /**
     * @ApiDoc(
     *  description="Siembras perdidas",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Siembra", "groups"={"Siembra"}}
     * )
     * @View(serializerGroups={"Siembra"})
     * @Get("/perdidas", name="perdidas")
     */
    public function getPerdidasAction() {
        $siembras = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->getPerdidas($this->getUser()->getId());
        
        return $siembras;
    }

    /**
     * @ApiDoc(
     *  description="Terreno cutivado con cada cultivo",
     *  resource=true,
     * )
     * @Get("/terreno_cultivado", name="terreno_cultivado")
     */
    public function getTerrenoCultivadoAction() {
        $array = [];
        
        $totales = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->getSueloTotalPorSiembra($this->getUser()->getId());
        $arrayTotales = [];
        foreach($totales as $cultivo) {
            $arrayTotales[$cultivo["cultivo"]] = (int)$cultivo["cantidad"];       
        }
        $array["all"] = $arrayTotales;
        
        $presentes = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->getSueloPresentePorSiembra($this->getUser()->getId());
        $arrayPresentes = [];
        foreach($presentes as $cultivo) {
            $arrayPresentes[$cultivo["cultivo"]] = (int)$cultivo["cantidad"];       
        }
        $array["present"] = $arrayPresentes;
        
        return $array;
    }
    
    /**
     * @ApiDoc(
     *  description="Terreno cutivado con cada cultivo",
     *  resource=true,
     * )
     * @Get("/rinde_promedio_anual", name="rinde_promedio_anual")
     */
    public function getRindePromedioAnualAction() {
        $promedios = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->getRindePromedioAnual($this->getUser()->getId());        
        $aux = [];
        foreach($promedios as $promedio) {
            if(array_key_exists($promedio["year"], $aux)) {
                $datos = [];
                $datos["cultivo"] = $promedio["cultivo"];
                $datos["cantidad"] = (int)$promedio["cantidad"];
                $aux[$promedio["year"]][] = $datos;
            } else {
                $datos = [];
                $datos["cultivo"] = $promedio["cultivo"];
                $datos["cantidad"] = (int)$promedio["cantidad"];
                $aux[$promedio["year"]] = [];
                $aux[$promedio["year"]][] = $datos;
            }
        }
        $arrayPromedios = [];
        foreach($aux as $key => $datos) {
            $aux2 = [];
            $aux2["year"] = (int)$key;
            $aux2["data"] = $datos;
            $arrayPromedios[] = $aux2;
        }
        $array = [];
        $array["data"] = $arrayPromedios;
        
        return $array;
    }
    
    /**
     * @ApiDoc(
     *  description="Ultimos 4 cosechas de cada lote",
     *  resource=true,
     * )
     * @Get("/cosechas_por_lotes", name="cosechas_por_lotes")
     */
    public function getUltimas4PorLoteAction() {
        $lotes = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->getConCosecha($this->getUser()->getId());
        
        $array = [];
        foreach ($lotes as $loteId) {
            $arrayDatos = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->getUltimas4PorLote($loteId["id"]);        
            $cosechas = [];
            foreach ($arrayDatos as $datos) {
                $aux = [];
                $aux["moment"] = $datos["fecha"];
                $aux["cost"] = $datos["costo"];
                $aux["profit"] = $datos["beneficio"];
                $cosechas[] = $aux;   
            }

            $lote = [];
            $lote["lote"] = $datos["nombre"];
            $lote["data"] = $cosechas;
            $array[] = $lote;
        }
     
        return array("data" => $array);
    }

}