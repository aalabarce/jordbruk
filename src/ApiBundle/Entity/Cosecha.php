<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Cosecha")
 */
class Cosecha {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha;
    
    /**
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\Siembra")
     */
    protected $siembra;

    /**
     * @ORM\Column(type="integer")
     */
    protected $rinde;
    /**
     * @ORM\Column(type="integer")
     */
    protected $beneficio;
        
    /**
     * @ORM\Column(type="string", nullable=true)
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