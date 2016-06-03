<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CosechaType extends AbstractType {
    
    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $usuario = $this->container->get('security.token_storage')->getToken()->getUser();
        
        $builder
            ->add('fecha', TextType::class, array("description" => "Fecha de cosecha", 'constraints' => new NotBlank()))
            ->add('siembra', null, array("description" => "Siembra", 'constraints' => new NotBlank()))
            ->add('siembra', EntityType::class , array(
                "description" => "Siembra",
                'constraints' => new NotBlank(),
                'class' => 'ApiBundle:Siembra',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) use ($usuario) {
                    return $er->createQueryBuilder('s')
                            ->innerJoin('s.lote', 'l')
                            ->where('l.usuario = :usuario')
                            ->setParameter("usuario", $usuario->getId());
                },
                'choice_label' => 'nombre'))
            ->add('rinde', null, array("description" => "Rinde", 'constraints' => new NotBlank()))
            ->add('beneficio', null, array("description" => "Beneficio", 'constraints' => new NotBlank()))
            ->add('descripcion', null, array("description" => "Descripcion"))
        ;
        
        $transformer = new DateTimeToStringTransformer(null, null, 'Y-m-d');
        $builder->add($builder->create('fecha', TextType::class)->addModelTransformer($transformer));
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
