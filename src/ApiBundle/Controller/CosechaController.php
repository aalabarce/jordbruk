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
use ApiBundle\Entity\Cosecha;
use ApiBundle\Form\CosechaType;

class CosechaController extends FOSRestController {

    /**
     * @ApiDoc(
     *  description="Crear una cosecha",
     *  resource=true,
     *  input={"class"="ApiBundle\Form\CosechaType"},
     *  output={"class"="ApiBundle\Entity\Cosecha", "groups"={"Cosecha"}}
     * )
     * @View(serializerGroups={"Cosecha"})
     * @Post("", name="api_cosecha_new")
     */
    public function newAction(Request $request) {
        if($this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->getPorSiembra($request->request->get('siembra'), $this->getUser()->getId()))
            throw new BadRequestHttpException("La siembra ya esta cosechada");
        
        $cosecha = new Cosecha();
        $form = $this->createForm(CosechaType::class, $cosecha);
                
        $siembra = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->find($request->request->get('siembra'));

        $fechaDate = new \DateTime($request->request->get('fecha'));
        $fechaDesde = clone $siembra->getFecha();
        $fechaDesde->add(new \DateInterval('P30D'));
        $fechaHasta = clone $siembra->getFecha();
        $fechaHasta->add(new \DateInterval('P90D'));
        
        if($fechaDesde > $fechaDate || $fechaDate > $fechaHasta) {
            throw new BadRequestHttpException("La fecha de la cosecha es invalida.");
        }
        
        $fecha = $request->request->get('fecha');
        if(strlen($fecha) > 10) {
           $y = substr($fecha, 0, 4);
           $m = substr($fecha, 5, 2);
           $d = substr($fecha, 8, 2);
           $fechaFormateada = "$d-$m-$y";
           $request->request->set('fecha', $fechaFormateada);
        }
        
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
     * @Put("/{id}", name="api_cosecha_edit")
     */
    public function editAction(Request $request, $id) {
        $cosecha = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->find($id);
        $form = $this->createForm(CosechaType::class, $cosecha);
                
        $fechaDate = new \DateTime($request->request->get('fecha'));
        $fechaDesde = clone $cosecha->getSiembra()->getFecha();
        $fechaDesde->add(new \DateInterval('P30D'));
        $fechaHasta = clone $cosecha->getSiembra()->getFecha();
        $fechaHasta->add(new \DateInterval('P90D'));
        
        if($fechaDesde > $fechaDate || $fechaDate > $fechaHasta) {
            throw new BadRequestHttpException("La fecha de la cosecha es invalida.");
        }
        
        $fecha = $request->request->get('fecha');
        if(strlen($fecha) > 10) {
           $y = substr($fecha, 0, 4);
           $m = substr($fecha, 5, 2);
           $d = substr($fecha, 8, 2);
           $fechaFormateada = "$d-$m-$y";
           $request->request->set('fecha', $fechaFormateada);
        }
        
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
     * @Delete("/{id}", name="api_cosecha_delete")
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
    public function obtenerAction(Request $request) {
        $usuario = $this->getUser();
        $busqueda = $request->get("busqueda");
        $fechaDesde = $request->get("fechaDesde");
        $fechaHasta = $request->get("fechaHasta");
        $cosechas = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->getBuscados($usuario->getId(), $busqueda, $fechaDesde, $fechaHasta);
        
        return $cosechas;
    }
}