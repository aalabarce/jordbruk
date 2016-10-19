<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LoteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nombre', null, array("description" => "Nombre identificador", 'constraints' => new NotBlank()))
            ->add('superficie', null, array("description" => "Superficie", 'constraints' => new NotBlank()))
            ->add('suelo', null, array("description" => "Suelo", 'constraints' => new NotBlank()))
            ->add('descripcion', null, array("description" => "Descripcion"))
            ->add('localidad', null, array("description" => "Localidad del lote", 'constraints' => new NotBlank()))
            ->add('provincia', null, array("description" => "Provincia del lote", 'constraints' => new NotBlank()))
            ->add('provincia', EntityType::class , array(
                "description" => "Lote",
                'constraints' => new NotBlank(),
                'class' => 'ApiBundle:Provincia',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                            ->where('p.id in (2,3,4,7,8,10,19,22)');
                },
                'choice_label' => 'nombre'))
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
