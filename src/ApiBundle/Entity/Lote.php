<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as GEDMO;
use Resources\Entity\BaseEntitySoftDelete;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\LoteRepository")
 * @ORM\Table(name="Lote")
 * @ORM\HasLifecycleCallbacks()
 * @GEDMO\SoftDeleteable(fieldName="deletedAt")
 * @ExclusionPolicy("all")
 */
class Lote extends BaseEntitySoftDelete {
    
    /**
     * @ORM\Column(type="string")
     * @Expose
     * @Groups({"Lote"})
     */
    protected $nombre;
    
    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Lote"})
     */
    protected $superficie;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Suelo")
     * @Expose
     * @Groups({"Lote"})
     */
    protected $suelo;
        
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Lote"})
     */
    protected $descripcion;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Usuario", inversedBy="lotes")
     */
    protected $usuario;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Provincia")
     * @Expose
     * @Groups({"Lote"})
     */
    protected $provincia;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Localidad")
     * @Expose
     * @Groups({"Lote"})
     */
    protected $localidad;

    
    public function __toString() {
        return $this->nombre;
    }

   
    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function getSuperficie() {
        return $this->superficie;
    }

    function setSuperficie($superficie) {
        $this->superficie = $superficie;
    }

    function getSuelo() {
        return $this->suelo;
    }

    function setSuelo($suelo) {
        $this->suelo = $suelo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    function getProvincia() {
        return $this->provincia;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }
}