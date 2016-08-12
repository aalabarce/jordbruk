<?php

namespace BackBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/zona")
 */
class ZonaController extends BaseController {
    
    /**
     * @Route("/localidades/{provinciaId}", name="get_localidades", options={"expose"=true})
     */
    public function getLocalidadesAction($provinciaId) {
        $opciones = array();
        $localidades = $this->getDoctrine()->getRepository('ApiBundle:Localidad')->findBy(array("provincia" => $provinciaId));
        foreach ($localidades as $localidad) {
            $opciones[$localidad->getId()] = $localidad->getNombre();
        }

        return new Response(json_encode($opciones));
    }
}