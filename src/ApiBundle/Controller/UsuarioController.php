<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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
            $usuario->setEnabled(true);
            
            $this->getDoctrine()->getManager()->persist($usuario);
            $this->getDoctrine()->getManager()->flush();
            
            return $usuario;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *  description="Obtener listado de usuarios",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Usuario"}
     * )
     * @Get("", name="api_obtener")
     */
    public function obtenerAction() {
        return $this->getDoctrine()->getManager()->getRepository('ApiBundle:Usuario')->findAll();
    }


}