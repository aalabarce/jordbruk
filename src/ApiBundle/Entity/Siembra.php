<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Siembra")
 */
class Siembra {
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
     * @ORM\Column(type="string")
     */
    protected $cultivo;
    
    /**
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\Lote")
     */
    protected $lote;

    /**
     * @ORM\Column(type="integer")
     */
    protected $aguaRecibida;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $fertilizado;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $fumigado;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $arado;

    /**
     * @ORM\Column(type="integer")
     */
    protected $costo;
        
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $descripcion;
            
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Usuario", inversedBy="siembras")
     */
    protected $usuario;
    
    

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function getCultivo() {
        return $this->cultivo;
    }

    function setCultivo($cultivo) {
        $this->cultivo = $cultivo;
    }

    function getLote() {
        return $this->lote;
    }

    function setLote($lote) {
        $this->lote = $lote;
    }

    function getAguaRecibida() {
        return $this->aguaRecibida;
    }

    function setAguaRecibida($aguaRecibida) {
        $this->aguaRecibida = $aguaRecibida;
    }

    function getFertilizado() {
        return $this->fertilizado;
    }

    function setFertilizado($fertilizado) {
        $this->fertilizado = $fertilizado;
    }

    function getFumigado() {
        return $this->fumigado;
    }

    function setFumigado($fumigado) {
        $this->fumigado = $fumigado;
    }

    function getArado() {
        return $this->arado;
    }

    function setArado($arado) {
        $this->arado = $arado;
    }

    function getCosto() {
        return $this->costo;
    }

    function setCosto($costo) {
        $this->costo = $costo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}