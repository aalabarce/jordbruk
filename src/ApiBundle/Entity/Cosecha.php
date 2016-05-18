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
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\Siembra")
     */
    protected $siembra;
    
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function getSiembra() {
        return $this->siembra;
    }

    function setSiembra($siembra) {
        $this->siembra = $siembra;
    }
}