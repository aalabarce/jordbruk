<?php

namespace BackBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormError;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ApiBundle\Entity\Cosecha;
use ApiBundle\Form\CosechaType;

/**
 * @Route("/cosecha")
 */
class CosechaController extends BaseController {
    
    /**
     * @Route("/", name="cosecha")
     */
    public function indexAction(Request $request) {
        $usuario = $this->getUser();
        $busqueda = $request->get("busqueda");
        $fechaDesde = $request->get("fechaDesde");
        $fechaHasta = $request->get("fechaHasta");
        $cosechas = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->getBuscados($usuario->getId(), $busqueda, $fechaDesde, $fechaHasta);
        
        return $this->render('BackBundle:Cosecha:index.html.twig', array(
            'cosechas' => $cosechas,
            'busqueda' => $busqueda,
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta
        ));
    }

    /**
     * @Route("/new", name="cosecha_new")
     */
    public function newAction() {
        $cosecha = new Cosecha();
        $form = $this->createForm(CosechaType::class, $cosecha);

        return $this->render('BackBundle:Cosecha:new.html.twig', array(
            'cosecha' => $cosecha,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/create", name="cosecha_create")
     */
    public function createAction(Request $request) {
        $cosecha = new Cosecha();
        $form = $this->createForm(CosechaType::class, $cosecha);
        $form->handleRequest($request);
        
        $siembra = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->find($request->get('cosecha')["siembra"]);

        $fecha = new \DateTime($request->get('cosecha')["fecha"]);
        $fechaDesde = clone $siembra->getFecha();
        $fechaDesde->add(new \DateInterval('P30D'));
        $fechaHasta = clone $siembra->getFecha();
        $fechaHasta->add(new \DateInterval('P90D'));
        
        if($fechaDesde > $fecha || $fecha > $fechaHasta) {
            $error = new FormError("La fecha de la cosecha es invalida.");
            $form->get('fecha')->addError($error);
        }
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($cosecha);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('cosecha'));
        }

        return $this->render('BackBundle:Cosecha:new.html.twig', array(
            'cosecha' => $cosecha,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="cosecha_edit")
     */
    public function editAction($id) {
        $cosecha = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Cosecha')->find($id);
        if (!$cosecha) 
            throw $this->createNotFoundException('Unable to find entity');
        
        $form = $this->createForm(CosechaType::class, $cosecha);

        return $this->render('BackBundle:Cosecha:edit.html.twig', array(
            'cosecha' => $cosecha,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/update/{id}", name="cosecha_update")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $cosecha = $em->getRepository('ApiBundle:Cosecha')->find($id);
        if (!$cosecha)
            throw $this->createNotFoundException('Unable to find entity');
        
        $form = $this->createForm(CosechaType::class, $cosecha);
        $form->handleRequest($request);

        $fecha = new \DateTime($request->get('cosecha')["fecha"]);
        $fechaDesde = clone $cosecha->getSiembra()->getFecha();
        $fechaDesde->add(new \DateInterval('P30D'));
        $fechaHasta = clone $cosecha->getSiembra()->getFecha();
        $fechaHasta->add(new \DateInterval('P90D'));
        
        if($fechaDesde > $fecha || $fecha > $fechaHasta) {
            $error = new FormError("La fecha de la cosecha es invalida.");
            $form->get('fecha')->addError($error);
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            return $this->redirect($this->generateUrl('cosecha'));
        }

        return $this->render('BackBundle:Cosecha:edit.html.twig', array(
            'cosecha' => $cosecha,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/delete/{id}", name="cosecha_delete", options={"expose"=true})
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $cosecha = $em->getRepository('ApiBundle:Cosecha')->find($id);
        if (!$cosecha)
            throw $this->createNotFoundException('Unable to find entity');

        $em->remove($cosecha);
        $em->flush();

        return new Response(200);
    }
}