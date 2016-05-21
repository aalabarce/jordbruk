<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity
 * @ORM\Table(name="Lote")
 * @ExclusionPolicy("all")
 */
class Lote {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Lote", "Siembra"})
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @Expose
     * @Groups({"Lote", "Siembra"})
     */
    protected $nombre;
    
    /**
     * @ORM\Column(type="integer")
     * @Expose
     * @Groups({"Lote"})
     */
    protected $superficie;
    
    /**
     * @ORM\Column(type="string")
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

    
    public function __toString() {
        return $this->nombre;
    }


    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
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
}