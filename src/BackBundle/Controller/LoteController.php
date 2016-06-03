<?php

namespace BackBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ApiBundle\Entity\Lote;
use ApiBundle\Form\LoteType;

/**
 * @Route("/lote")
 */
class LoteController extends BaseController {
    
    /**
     * @Route("/", name="lote")
     */
    public function indexAction() {
        $usuario = $this->getUser();
        $lotes = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->findBy(array('usuario' => $usuario->getId()));
        
        return $this->render('BackBundle:Lote:index.html.twig', array(
            'lotes' => $lotes,
        ));
    }

    /**
     * @Route("/new", name="lote_new")
     */
    public function newAction() {
        $lote = new Lote();
        $form = $this->createForm(LoteType::class, $lote);

        return $this->render('BackBundle:Lote:new.html.twig', array(
            'lote' => $lote,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/create", name="lote_create")
     */
    public function createAction(Request $request) {
        $lote = new Lote();
        $form = $this->createForm(LoteType::class, $lote);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $usuario = $this->container->get('security.token_storage')->getToken()->getUser();
            $lote->setUsuario($usuario);
            $this->getDoctrine()->getManager()->persist($lote);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('lote'));
        }

        return $this->render('BackBundle:Lote:new.html.twig', array(
            'lote' => $lote,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="lote_edit")
     */
    public function editAction($id) {
        $lote = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->find($id);
        if (!$lote) 
            throw $this->createNotFoundException('Unable to find entity');
        
        $form = $this->createForm(LoteType::class, $lote);

        return $this->render('BackBundle:Lote:edit.html.twig', array(
            'lote' => $lote,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/update/{id}", name="lote_update")
     */
    public function updateAction(Request $request, $id) {
        $lote = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Lote')->find($id);
        if (!$lote)
            throw $this->createNotFoundException('Unable to find entity');
        
        $form = $this->createForm(LoteType::class, $lote);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirect($this->generateUrl('lote'));
        }

        return $this->render('BackBundle:Lote:edit.html.twig', array(
            'lote' => $lote,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/delete/{id}", name="lote_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $lote = $em->getRepository('ApiBundle:Lote')->find($id);
        if (!$lote)
            throw $this->createNotFoundException('Unable to find entity');

        $em->remove($lote);
        $em->flush();

        return $this->redirect($this->generateUrl('lote'));
    }
}