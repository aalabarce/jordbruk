<?php

namespace BackBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Form\FormError;
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
        
        if($this->getDoctrine()->getManager()->getRepository('ApiBundle:Usuario')->findOneBy(array('username' => $request->get('usuario')["username"] ))) {
            $error = new FormError("Este nombre de usuario ya esta en uso.");
            $form->get('username')->addError($error);
        }
        
        if($this->getDoctrine()->getManager()->getRepository('ApiBundle:Usuario')->findOneBy(array('email' => $request->get('usuario')["email"] ))) {
            $error = new FormError("Este email ya esta en uso.");
            $form->get('email')->addError($error);
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($usuario, $usuario->getPlainPassword());
            $usuario->setPassword($password);
            $usuario->setEnabled(true);
            
            $this->getDoctrine()->getManager()->persist($usuario);
            $this->getDoctrine()->getManager()->flush();

            $token = new UsernamePasswordToken($usuario, null, 'main', $usuario->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));
        
            return $this->redirectToRoute('home');
        }
        
        return $this->render('BackBundle:Usuario:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}