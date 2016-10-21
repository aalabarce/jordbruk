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
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\SiembraRepository")
 * @ORM\Table(name="Siembra")
 * @ORM\HasLifecycleCallbacks()
 * @GEDMO\SoftDeleteable(fieldName="deletedAt")
 * @ExclusionPolicy("all")
 */
class Siembra extends BaseEntitySoftDelete {
    
    /**
     * @ORM\Column(type="date")
     * @Expose
     * @Groups({"Siembra"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $fecha;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Cultivo")
     * @Expose
     * @Groups({"Siembra"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $cultivo;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Lote", cascade={"remove"})
     * @Expose
     * @Groups({"Siembra"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $lote;

    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Siembra"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $aguaRecibida;

    /**
     * @ORM\Column(type="boolean")
     * @Expose
     * @Groups({"Siembra"})
     */
    protected $fertilizado;

    /**
     * @ORM\Column(type="boolean")
     * @Expose
     * @Groups({"Siembra"})
     */
    protected $fumigado;

    /**
     * @ORM\Column(type="boolean")
     * @Expose
     * @Groups({"Siembra"})
     */
    protected $arado;

    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Siembra"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     * @Assert\Range(min = 1, minMessage = "El costo debe ser mayor a 0.")
     */
    protected $costo;
        
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Siembra"})
     */
    protected $descripcion;
    
        
    public function __toString() {
        $lote = $this->lote->getNombre();
        $cultivo = $this->cultivo->getNombre();
        $fecha = $this->fecha->format('d-m-Y');
        return "$lote - $cultivo ($fecha)";
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