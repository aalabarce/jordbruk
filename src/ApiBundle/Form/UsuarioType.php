<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class UsuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', null, array("description" => "Usuario"))
            ->add('plainPassword', null, array("description" => "Contraseña", 'constraints' => new NotBlank()))
            ->add('email', null, array("description" => "Email del usuario"))
            ->add('nombre', null, array("description" => "Nombre del usuario", 'constraints' => new NotBlank()))
            ->add('apellido', null, array("description" => "Apellido del usuario", 'constraints' => new NotBlank()))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BackBundle\Entity\Usuario',
            'cascade_validation' => false,
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'usuario';
    }

}
