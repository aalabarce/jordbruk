<?php

namespace BackBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ApiBundle\Entity\Usuario;
use ApiBundle\Form\UsuarioType;

/**
 * @Route("/registrar")
 */
class UsuarioController extends BaseController
{
    
    /**
     * @Route("/", name="registrar")
     */
    public function registrarAction(Request $request) {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($usuario, $usuario->getPlainPassword());
            $usuario->setPassword($password);
            $usuario->setRoles(array("ROLE_USER"));
            $usuario->setEnabled(true);
            
            $this->getDoctrine()->getManager()->persist($usuario);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home');
        }
        
        return $this->render('BackBundle:Usuario:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}