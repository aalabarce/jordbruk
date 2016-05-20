<?php

namespace ApiBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */
class Usuario extends BaseUser {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $apellido;
    
    /**
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Lote", mappedBy="usuario")
     */
    protected $lotes;
    
    /**
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Siembra", mappedBy="usuario")
     */
    protected $siembras;
    
    
    public function __construct() {
        parent::__construct();
        $this->roles = array("ROLE_USER");
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

    function getApellido() {
        return $this->apellido;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    
    function getLotes() {
        return $this->lotes;
    }

    function setLotes($lotes) {
        $this->lotes = $lotes;
    }
    
    function getSiembras() {
        return $this->siembras;
    }

    function setSiembras($siembras) {
        $this->siembras = $siembras;
    }
}