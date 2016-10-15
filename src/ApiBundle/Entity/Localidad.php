<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity
 * @ORM\Table(name="Localidad")
 * @ExclusionPolicy("all")
 */
class Localidad {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Lote","Usuario"})
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @Expose
     * @Groups({"Lote","Usuario"})
     */
    protected $nombre;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Provincia")
     * @Expose
     */
    protected $provincia;

        
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

    function getProvincia() {
        return $this->provincia;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

}