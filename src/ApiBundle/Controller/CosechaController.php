<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use ApiBundle\Entity\Cosecha;
use ApiBundle\Form\CosechaType;

class CosechaController extends FOSRestController {

    /**
     * @ApiDoc(
     *  description="Crear un cosecha",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\CosechaType"},
     *  output={"class"="ApiBundle\Entity\Cosecha"}
     * )
     * @Post("", name="api_cosecha_new")
     */
    public function newAction(Request $request) {
        $cosecha = new Cosecha();
        $form = $this->createForm(CosechaType::class, $cosecha);
        $form->submit($request->request->all());
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($cosecha);
            $this->getDoctrine()->getManager()->flush();
            
            return "ok";
//            return $cosecha;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *  description="Editar un cosecha",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\CosechaType"},
     *  output={"class"="ApiBundle\Entity\Cosecha"}
     * )
     * @Post("/editar/{id}", name="api_cosecha_edit")
     */
    public function editAction(Request $request, $id) {
        $cosecha = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->find($id);
        $form = $this->createForm(CosechaType::class, $cosecha);
        $form->submit($request->request->all());
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return "ok";
//            return $cosecha;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *  description="Obtener cosechas",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Cosecha"}
     * )
     * @Get("", name="api_cosecha_obtener")
     */
    public function obtenerAction() {
        $usuario = $this->container->get('security.token_storage')->getToken()->getUser();
        return $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->getPorUsuario($usuario);
    }
}