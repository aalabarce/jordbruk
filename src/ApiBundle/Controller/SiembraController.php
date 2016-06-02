<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\View;
use ApiBundle\Entity\Siembra;
use ApiBundle\Form\SiembraType;

class SiembraController extends FOSRestController {

    /**
     * @ApiDoc(
     *  description="Crear una siembra",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\SiembraType"},
     *  output={"class"="ApiBundle\Entity\Siembra", "groups"={"Siembra"}}
     * )
     * @View(serializerGroups={"Siembra"})
     * @Post("", name="api_siembra_new")
     */
    public function newAction(Request $request) {
        $siembra = new Siembra();
        $form = $this->createForm(SiembraType::class, $siembra);
        $form->submit($request->request->all());
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($siembra);
            $this->getDoctrine()->getManager()->flush();
            
            return $siembra;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *  description="Editar una siembra",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\SiembraType"},
     *  output={"class"="ApiBundle\Entity\Siembra", "groups"={"Siembra"}}
     * )
     * @View(serializerGroups={"Siembra"})
     * @Post("/editar/{id}", name="api_siembra_edit")
     */
    public function editAction(Request $request, $id) {
        $siembra = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->find($id);
        $form = $this->createForm(SiembraType::class, $siembra);
        $form->submit($request->request->all());
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

        return $siembra;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *  description="Eliminar una siembra",
     *  resource=true
     * )
     * @Delete("/{id}", name="api_siembra_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $siembra = $em->getRepository('ApiBundle:Siembra')->find($id);
        $em->remove($siembra);
        $em->flush();
        
        return "ok";
    }

    /**
     * @ApiDoc(
     *  description="Obtener siembras",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Siembra", "groups"={"Siembra"}}
     * )
     * @View(serializerGroups={"Siembra"})
     * @Get("", name="api_siembra_obtener")
     */
    public function obtenerAction() {
        $usuario = $this->container->get('security.token_storage')->getToken()->getUser();
        return $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->getPorUsuario($usuario);
    }
}