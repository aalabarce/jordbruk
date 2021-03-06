<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SiembraType extends AbstractType {

    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $usuario = $this->container->get('security.token_storage')->getToken()->getUser();
                
        $builder
            ->add('fecha', TextType::class, array("description" => "Fecha de siembra"))
            ->add('cultivo', EntityType::class , array(
                "description" => "Cultivo",
                'class' => 'ApiBundle:Cultivo',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('c')->orderBy('c.nombre');
                },
                'choice_label' => 'nombre'))
            ->add('lote', EntityType::class , array(
                "description" => "Lote",
                'class' => 'ApiBundle:Lote',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) use ($usuario) {
                    return $er->createQueryBuilder('l')
                            ->where('l.usuario = :usuario')
                            ->orderBy('l.nombre','asc')
                            ->setParameter("usuario", $usuario->getId());
                },
                'choice_label' => 'nombre'))
            ->add('aguaRecibida', null, array("description" => "Cantidad de agua recibida"))
            ->add('fertilizado', null, array("description" => "Si el campo fue fertilizado o no"))
            ->add('fumigado', null, array("description" => "Si el campo fue fumigado o no"))
            ->add('arado', null, array("description" => "Si el campo fue arado o no"))
            ->add('costo', null, array("description" => "Costo"))
            ->add('descripcion', null, array("description" => "Descripcion"))
        ;
        
        $transformer = new DateTimeToStringTransformer(null, null, 'd-m-Y');
        $builder->add($builder->create('fecha', TextType::class)->addModelTransformer($transformer));
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