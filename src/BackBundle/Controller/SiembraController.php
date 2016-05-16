<?php

namespace BackBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackBundle\Entity\Datos;
use BackBundle\Form\DatosType;

/**
 * @Route("/siembra")
 */
class SiembraController extends BaseController
{
    
    /**
     * @Route("/", name="siembra_index")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $usuarioId = $this->container->get('security.context')->getToken()->getUser();
        $datos = $em->getRepository('BackBundle:Datos')->findBy(array('id' => $usuarioId));
        
        return $this->render('BackBundle:Siembra:index.html.twig', array(
            'datos' => $datos,
        ));
    }

    /**
     * @Route("/new", name="siembra_new")
     */
    public function newAction() {
        $datos = new Datos();
        $form = $this->createForm(DatosType::class, $datos);

        return $this->render('BackBundle:Siembra:new.html.twig', array(
            'datos' => $datos,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/create", name="siembra_create")
     */
    public function createAction(Request $request) {
        $datos = new Datos();
        $form = $this->createForm(DatosType::class, $datos);
        $form->submit($request->request->all());
        
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($datos);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('siembra'));
        }

        return $this->render('BackBundle:Siembra:new.html.twig', array(
            'datos' => $datos,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="siembra_edit")
     */
    public function editAction($id) {
        $datos = $this->getDoctrine()->getManager()->getRepository('BackBundle:Datos')->find($id);
        if (!$datos) 
            throw $this->createNotFoundException('Unable to find entity');
        
        $form = $this->createForm(DatosType::class, $datos);

        return $this->render('BackBundle:Siembra:edit.html.twig', array(
                    'datos' => $datos,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/update/{id}", name="siembra_update")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $datos = $em->getRepository('BackBundle:Datos')->find($id);
        if (!$datos)
            throw $this->createNotFoundException('Unable to find entity');
        
        $form = $this->createForm(DatosType::class, $datos);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            return $this->redirect($this->generateUrl('siembra'));
        }

        return $this->render('BackBundle:Siembra:edit.html.twig', array(
                    'datos' => $datos,
                    'form' => $form->createView(),
        ));
    }
    
}