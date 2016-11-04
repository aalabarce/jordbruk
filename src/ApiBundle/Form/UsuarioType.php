<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UsuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', null, array("description" => "Usuario"))
            ->add('plainPassword', null, array("description" => "Contraseña"))
            ->add('email', null, array("description" => "Email del usuario"))
            ->add('nombre', null, array("description" => "Nombre del usuario"))
            ->add('apellido', null, array("description" => "Apellido del usuario"))
            ->add('telefono', null, array("description" => "Telefono del usuario"))
            ->add('localidad', null, array("description" => "Localidad del usuario"))
            ->add('provincia', EntityType::class , array(
                "description" => "Provincia",
                'class' => 'ApiBundle:Provincia',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('p')->orderBy('p.nombre', 'ASC');
                },
                'choice_label' => 'nombre'))
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
