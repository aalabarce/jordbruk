<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use BackBundle\Entity\Usuario;
use ApiBundle\Form\UsuarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcherInterface;

class UsuarioController extends FOSRestController {

    /**
     * @ApiDoc(
     *  description="Crear un nuevo usuario",
     *  resource=true,
     *  input={"name"="", "class"="ApiBundle\Form\UsuarioType"},
     *  output={"class"="BackBundle/Entity/Usuario"}
     * )
     * @Post("/registrar")
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

}