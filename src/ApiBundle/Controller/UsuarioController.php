<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use ApiBundle\Entity\Usuario;
use ApiBundle\Form\UsuarioType;

class UsuarioController extends FOSRestController {

    /**
     * @ApiDoc(
     *  description="Crear un nuevo usuario",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\UsuarioType"},
     *  output={"class"="ApiBundle\Entity\Usuario"}
     * )
     * @Post("/registrar", name="api_registrar")
     */
    public function registrarAction(Request $request) {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->submit(($request->request->all()));
        
        if ($form->isValid()) {
            $usuario->setRoles(array("ROLE_USER"));
            $usuario->setEnabled(true);
            
            $this->getDoctrine()->getManager()->persist($usuario);
            $this->getDoctrine()->getManager()->flush();
            
            return $usuario;
        } else {
            return $form;
        }
    }

    /**
     * @return array
     *
     * @ApiDoc(
     *  description="Obtener listado de usuarios",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Usuario"}
     * )
     * @Get("/", name="api_obtener")
     */
    public function obtenerAction()
    {
        $response = array();
        $em = $this->getDoctrine()->getManager();
        $usuarios = $em->getRepository('ApiBundle:Usuario')->findAll();

        if(!$usuarios)
        {
             return $this->view(null, 400);
        }

        return $this->view($usuarios, 200);
    }


}