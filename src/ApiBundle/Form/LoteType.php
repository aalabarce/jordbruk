<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nombre', null, array("description" => "Nombre identificador", 'constraints' => new NotBlank()))
            ->add('superficie', null, array("description" => "Superficie", 'constraints' => new NotBlank()))
            ->add('suelo', null, array("description" => "Suelo", 'constraints' => new NotBlank()))
            ->add('descripcion', null, array("description" => "Descripcion"))
            ->add('localidad', null, array("description" => "Localidad del lote", 'constraints' => new NotBlank()))
            ->add('provincia', null, array("description" => "Provincia del lote", 'constraints' => new NotBlank()))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ApiBundle\Entity\Lote',
            'cascade_validation' => false,
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'lote';
    }

}
