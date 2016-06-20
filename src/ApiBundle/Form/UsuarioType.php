<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UsuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', null, array("description" => "Usuario", 'constraints' => new NotBlank()))
            ->add('plainPassword', null, array("description" => "Contraseña", 'constraints' => new NotBlank()))
            ->add('email', null, array("description" => "Email del usuario", 'constraints' => new NotBlank()))
            ->add('nombre', null, array("description" => "Nombre del usuario", 'constraints' => new NotBlank()))
            ->add('apellido', null, array("description" => "Apellido del usuario", 'constraints' => new NotBlank()))
            ->add('ciudad', null, array("description" => "Ciudad del usuario", 'constraints' => new NotBlank()))
            ->add('provincia', null, array("description" => "Provincia del usuario", 'constraints' => new NotBlank()))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ApiBundle\Entity\Usuario',
            'cascade_validation' => false,
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'usuario';
    }

}
