<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class CultivoController extends FOSRestController {
    /**
     * @ApiDoc(
     *  description="Obtener listado de cultivos",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Cultivo", "groups"={"Cultivo"}}
     * )
     * @View(serializerGroups={"Cultivo"})
     * @Get("", name="api_cultivo_obtener")
     */
    public function obtenerAction() {
        return $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cultivo')->findAll();
    }


}