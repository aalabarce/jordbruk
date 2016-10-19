<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity
 * @ORM\Table(name="Provincia")
 * @ExclusionPolicy("all")
 */
class Provincia {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Provincia", "Lote", "Usuario"})
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @Expose
     * @Groups({"Provincia", "Lote", "Usuario"})
     */
    protected $nombre;
    
    
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

}