<?php

namespace BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nombre')
            ->add('apellido');
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix() {
        return 'app_user_registration';
    }

    
    public function getName() {
        return 'registrar';
    }
}