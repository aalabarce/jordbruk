<?php

namespace BackBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
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
    public function indexAction() {
        $usuario = $this->container->get('security.token_storage')->getToken()->getUser();
        $siembras = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Siembra')->getPorUsuario($usuario->getId());
        
        return $this->render('BackBundle:Siembra:index.html.twig', array(
            'siembras' => $siembras,
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
     * @Route("/delete/{id}", name="siembra_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $siembra = $em->getRepository('ApiBundle:Siembra')->find($id);
        if (!$siembra)
            throw $this->createNotFoundException('Unable to find entity');

        $em->remove($siembra);
        $em->flush();

        return $this->redirect($this->generateUrl('siembra'));
    }
}