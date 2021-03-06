<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as GEDMO;
use Resources\Entity\BaseEntitySoftDelete;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\CosechaRepository")
 * @ORM\Table(name="Cosecha")
 * @ORM\HasLifecycleCallbacks()
 * @GEDMO\SoftDeleteable(fieldName="deletedAt")
 * @ExclusionPolicy("all")
 */
class Cosecha extends BaseEntitySoftDelete {

    /**
     * @ORM\Column(type="date")
     * @Expose
     * @Groups({"Cosecha"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $fecha;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Siembra")
     * @Expose
     * @Groups({"Cosecha"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $siembra;

    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Cosecha"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $rinde;
    
    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Cosecha"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $beneficio;
        
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Cosecha"})
     */
    protected $descripcion;

    
    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    
    function getSiembra() {
        return $this->siembra;
    }

    function setSiembra($siembra) {
        $this->siembra = $siembra;
    }

    function getRinde() {
        return $this->rinde;
    }

    function setRinde($rinde) {
        $this->rinde = $rinde;
    }

    function getBeneficio() {
        return $this->beneficio;
    }

    function setBeneficio($beneficio) {
        $this->beneficio = $beneficio;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}