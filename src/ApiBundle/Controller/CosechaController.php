<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use ApiBundle\Entity\Cosecha;
use ApiBundle\Form\CosechaType;

class CosechaController extends FOSRestController {

    /**
     * @ApiDoc(
     *  description="Crear uns cosecha",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\CosechaType"},
     *  output={"class"="ApiBundle\Entity\Cosecha", "groups"={"Cosecha"}}
     * )
     * @View(serializerGroups={"Cosecha"})
     * @Post("", name="api_cosecha_new")
     */
    public function newAction(Request $request) {
        $cosecha = new Cosecha();
        $form = $this->createForm(CosechaType::class, $cosecha);
        $form->submit($request->request->all());
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($cosecha);
            $this->getDoctrine()->getManager()->flush();
            
            return $cosecha;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *  description="Editar una cosecha",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\CosechaType"},
     *  output={"class"="ApiBundle\Entity\Cosecha", "groups"={"Cosecha"}}
     * )
     * @View(serializerGroups={"Cosecha"})
     * @Post("/editar/{id}", name="api_cosecha_edit")
     */
    public function editAction(Request $request, $id) {
        $cosecha = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->find($id);
        $form = $this->createForm(CosechaType::class, $cosecha);
        $form->submit($request->request->all());
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $cosecha;
        } else {
            return $form;
        }
    }
    
    /**
     * @ApiDoc(
     *  description="Eliminar una cosecha",
     *  resource=true
     * )
     * @Post("/delete/{id}", name="api_cosecha_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $cosecha = $em->getRepository('ApiBundle:Cosecha')->find($id);
        $em->remove($cosecha);
        $em->flush();
        
        return "ok";
    }
    
    /**
     * @ApiDoc(
     *  description="Obtener cosechas",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Cosecha", "groups"={"Cosecha"}}
     * )
     * @View(serializerGroups={"Cosecha"})
     * @Get("", name="api_cosecha_obtener")
     */
    public function obtenerAction() {
        $usuario = $this->container->get('security.token_storage')->getToken()->getUser();
        return $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->getPorUsuario($usuario);
    }
}