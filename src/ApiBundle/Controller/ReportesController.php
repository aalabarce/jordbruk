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
     * @Get("/_sin_cosechar", name="sin_cosechar")
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
}