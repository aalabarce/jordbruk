<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\View;
use ApiBundle\Entity\Lote;
use ApiBundle\Form\LoteType;

class LoteController extends FOSRestController {

    /**
     * @ApiDoc(
     *  description="Crear un lote",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\LoteType"},
     *  output={"class"="ApiBundle\Entity\Lote", "groups"={"Lote"}}
     * )
     * @View(serializerGroups={"Lote"})
     * @Post("", name="api_lote_new")
     */
    public function newAction(Request $request) {
        if($this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->getPorNombre($request->request->get('nombre'), $this->getUser()->getId()))
            throw new BadRequestHttpException("Ya existe un lote con ese nombre");

        $lote = new Lote();
        $form = $this->createForm(LoteType::class, $lote);
        $form->submit($request->request->all());
        
        if ($form->isValid()) {
            $usuario = $this->getUser();
            $lote->setUsuario($usuario);
            $this->getDoctrine()->getManager()->persist($lote);
            $this->getDoctrine()->getManager()->flush();
            
            return $lote;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *  description="Editar un lote",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\LoteType"},
     *  output={"class"="ApiBundle\Entity\Lote", "groups"={"Lote"}}
     * )
     * @View(serializerGroups={"Lote"})
     * @Put("/{id}", name="api_lote_edit")
     */
    public function editAction(Request $request, $id) {
        $lote = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->find($id);
        $form = $this->createForm(LoteType::class, $lote);
        $form->submit($request->request->all());
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $lote;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *  description="Eliminar un lote",
     *  resource=true
     * )
     * @Delete("/{id}", name="api_lote_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $lote = $em->getRepository('ApiBundle:Lote')->find($id);
        $em->remove($lote);
        $em->flush();
        
        return "ok";
    }
    
    /**
     * @ApiDoc(
     *  description="Obtener lotes",
     *  resource=true,
     *  output={"class"="ApiBundle\Entity\Lote", "groups"={"Lote"}}
     * )
     * @View(serializerGroups={"Lote"})
     * @Get("", name="api_lote_obtener")
     */
    public function obtenerAction(Request $request) {
        $busqueda = $request->get("busqueda");
        return $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->getBuscados($this->getUser()->getId(), $busqueda);
    }
}