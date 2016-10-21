<?php

namespace BackBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormError;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ApiBundle\Entity\Siembra;
use ApiBundle\Form\SiembraType;

/**
 * @Route("/siembra")
 */
class SiembraController extends BaseController {
    
    /**
     * @Route("/", name="siembra")
     */
    public function indexAction(Request $request) {
        $usuario = $this->getUser();
        $busqueda = $request->get("busqueda");
        $fechaDesde = $request->get("fechaDesde");
        $fechaHasta = $request->get("fechaHasta");
        $lote = $request->get("loteId");
        if($request->get("acciones")) {
            $fumigado = in_array("fumigado", $request->get("acciones")) ? true : false;
            $fertilizado = in_array("fertilizado", $request->get("acciones")) ? true : false;
            $arado = in_array("arado", $request->get("acciones")) ? true : false;
        } else {
            $fumigado = null;
            $fertilizado = null;
            $arado = null;
        }
        
        $siembras = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->getBuscados($usuario->getId(), $busqueda, $fechaDesde, $fechaHasta, $fertilizado, $fumigado, $arado, $lote);
        $lotes = $usuario->getLotes();
        
        return $this->render('BackBundle:Siembra:index.html.twig', array(
            'siembras' => $siembras,
            'busqueda' => $busqueda,
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta,
            'fumigado' => $fumigado,
            'fertilizado' => $fertilizado,
            'arado' => $arado,
            'lotes' => $lotes,
            'loteId' => $lote
        ));
    }

    /**
     * @Route("/new", name="siembra_new")
     */
    public function newAction() {
        $siembra = new Siembra();
        $form = $this->createForm(SiembraType::class, $siembra);

        return $this->render('BackBundle:Siembra:new.html.twig', array(
            'siembra' => $siembra,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/create", name="siembra_create")
     */
    public function createAction(Request $request) {
        $siembra= new Siembra();
        $form = $this->createForm(SiembraType::class, $siembra);
        $form->handleRequest($request);
        
        $ultimaSiembra = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->getUltimasSiembra($request->get('siembra')["lote"]);
        if($ultimaSiembra && date_diff(new \DateTime($request->get('siembra')["fecha"]), $ultimaSiembra[0]->getFecha())->days < 90) {
            $error = new FormError("Este lote ya esta sembrado para la fecha seleccionada.");
            $form->get('fecha')->addError($error);
        }
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($siembra);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('siembra'));
        }

        return $this->render('BackBundle:Siembra:new.html.twig', array(
            'siembra' => $siembra,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="siembra_edit")
     */
    public function editAction($id) {
        $siembra = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->find($id);
        if (!$siembra) 
            throw $this->createNotFoundException('Unable to find entity');
        
        $form = $this->createForm(SiembraType::class, $siembra);

        return $this->render('BackBundle:Siembra:edit.html.twig', array(
            'siembra' => $siembra,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/update/{id}", name="siembra_update")
     */
    public function updateAction(Request $request, $id) {
        $siembra = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->find($id);
        if (!$siembra)
            throw $this->createNotFoundException('Unable to find entity');
        
        $form = $this->createForm(SiembraType::class, $siembra);
        $form->handleRequest($request);

        $ultimaSiembra = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->getUltimasSiembra($request->get('siembra')["lote"]);
        if($ultimaSiembra && date_diff(new \DateTime($request->get('siembra')["fecha"]), $ultimaSiembra[0]->getFecha())->days < 90) {
            $error = new FormError("Este lote ya esta sembrado para la fecha seleccionada.");
            $form->get('fecha')->addError($error);
        }

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirect($this->generateUrl('siembra'));
        }

        return $this->render('BackBundle:Siembra:edit.html.twig', array(
            'siembra' => $siembra,
            'form' => $form->createView(),
        ));
    }
       
    /**
     * @Route("/delete/{id}", name="siembra_delete", options={"expose"=true})
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $siembra = $em->getRepository('ApiBundle:Siembra')->find($id);
        if (!$siembra)
            throw $this->createNotFoundException('Unable to find entity');
        
        foreach($em->getRepository('ApiBundle:Cosecha')->findBy(array("siembra" => $id)) as $cosecha) {
            $em->remove($cosecha);
        }
        
        $em->remove($siembra);
        $em->flush();

        return new Response(200);
    }
}