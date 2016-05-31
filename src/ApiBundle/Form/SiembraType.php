<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;

class SiembraType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nombre', null, array("description" => "Nombre identificador", 'constraints' => new NotBlank()))
            ->add('fecha', TextType::class, array("description" => "Fecha de siembra", 'constraints' => new NotBlank()))
            ->add('cultivo', null, array("description" => "Cultivo", 'constraints' => new NotBlank()))
            ->add('lote', null, array("description" => "Lote", 'constraints' => new NotBlank()))
            ->add('aguaRecibida', null, array("description" => "Cantidad de agua recibida", 'constraints' => new NotBlank()))
            ->add('fertilizado', null, array("description" => "Si el campo fue fertilizado o no"))
            ->add('fumigado', null, array("description" => "Si el campo fue fumigado o no"))
            ->add('arado', null, array("description" => "Si el campo fue arado o no"))
            ->add('costo', null, array("description" => "Costo", 'constraints' => new NotBlank()))
            ->add('descripcion', null, array("description" => "Descripcion"))
        ;
        
        $transformer = new DateTimeToStringTransformer(null, null, 'Y-m-d');
        $builder->add($builder->create('fecha', TextType::class)
            ->addModelTransformer($transformer)
        );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ApiBundle\Entity\Siembra',
            'cascade_validation' => false,
            'csrf_protection' => false
        ));
    }

    public function getName() {
        return 'siembra';
    }

}
