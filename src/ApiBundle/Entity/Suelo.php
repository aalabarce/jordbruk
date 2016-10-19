<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as GEDMO;
use Resources\Entity\BaseEntitySoftDelete;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity
 * @ORM\Table(name="Suelo")
 * @ORM\HasLifecycleCallbacks()
 * @GEDMO\SoftDeleteable(fieldName="deletedAt")
 * @ExclusionPolicy("all")
 */
class Suelo extends BaseEntitySoftDelete {
    
    /**
     * @ORM\Column(type="string")
     * @Expose
     * @Groups({"Suelo","Lote"})
     */
    protected $nombre;
   
    
    public function __toString() {
        return $this->nombre;
    }
   
    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}