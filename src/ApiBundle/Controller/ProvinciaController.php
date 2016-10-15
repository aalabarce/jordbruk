<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class ProvinciaController extends FOSRestController {
    
    /**
     * @ApiDoc(
     *  description="Obtener listado de provincias",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Provincia", "groups"={"Provincia"}}
     * )
     * @View(serializerGroups={"Provincia"})
     * @Get("", name="api_provincia_obtener")
     */
    public function obtenerAction() {
        return $this->getDoctrine()->getManager()->getRepository('ApiBundle:Provincia')->findAll();
    }


}