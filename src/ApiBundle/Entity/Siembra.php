<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as GEDMO;
use Resources\Entity\BaseEntitySoftDelete;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\SiembraRepository")
 * @ORM\Table(name="Siembra")
 * @ORM\HasLifecycleCallbacks()
 * @GEDMO\SoftDeleteable(fieldName="deletedAt")
 * @ExclusionPolicy("all")
 */
class Siembra extends BaseEntitySoftDelete {
    
    /**
     * @ORM\Column(type="string")
     * @Expose
     * @Groups({"Siembra", "Cosecha"})
     */
    protected $nombre;
    
    /**
     * @ORM\Column(type="date")
     * @Expose
     * @Groups({"Siembra", "Cosecha"})
     */
    protected $fecha;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Cultivo")
     * @Expose
     * @Groups({"Siembra", "Cosecha"})
     */
    protected $cultivo;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Lote")
     * @Expose
     * @Groups({"Siembra"})
     */
    protected $lote;

    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Siembra", "Cosecha"})
     */
    protected $aguaRecibida;

    /**
     * @ORM\Column(type="boolean")
     * @Expose
     * @Groups({"Siembra", "Cosecha"})
     */
    protected $fertilizado;

    /**
     * @ORM\Column(type="boolean")
     * @Expose
     * @Groups({"Siembra", "Cosecha"})
     */
    protected $fumigado;

    /**
     * @ORM\Column(type="boolean")
     * @Expose
     * @Groups({"Siembra", "Cosecha"})
     */
    protected $arado;

    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Siembra", "Cosecha"})
     */
    protected $costo;
        
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Siembra", "Cosecha"})
     */
    protected $descripcion;
    
        
    public function __toString() {
        return $this->nombre;
    }
    
    
    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
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