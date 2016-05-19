<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CosechaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('fecha', null, array("description" => "Fecha de cosecha", 'constraints' => new NotBlank()))
            ->add('siembra', null, array("description" => "Siembra", 'constraints' => new NotBlank()))
            ->add('rinde', null, array("description" => "Rinde", 'constraints' => new NotBlank()))
            ->add('beneficio', null, array("description" => "Beneficio", 'constraints' => new NotBlank()))
            ->add('descripcion', null, array("description" => "Descripcion", 'constraints' => new NotBlank()))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ApiBundle\Entity\Cosecha',
            'cascade_validation' => false,
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'cosecha';
    }

}
