<?php

namespace ApiBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */
class Usuario extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @var type 
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var type 
     */
    protected $apellido;
    
    
    public function __construct()
    {
        parent::__construct();
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

}
