<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as GEDMO;
use Resources\Entity\BaseEntitySoftDelete;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\CosechaRepository")
 * @ORM\Table(name="Cosecha")
 * @ExclusionPolicy("all")
 */
class Cosecha extends BaseEntitySoftDelete {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Cosecha"})
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     * @Expose
     * @Groups({"Cosecha"})
     */
    protected $fecha;
    
    /**
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\Siembra")
     * @Expose
     * @Groups({"Cosecha"})
     */
    protected $siembra;

    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Cosecha"})
     */
    protected $rinde;
    
    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Cosecha"})
     */
    protected $beneficio;
        
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Cosecha"})
     */
    protected $descripcion;
    

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    
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