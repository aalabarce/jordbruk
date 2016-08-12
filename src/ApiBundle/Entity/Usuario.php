<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 * @ExclusionPolicy("all")
 */
class Usuario extends BaseUser {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Usuario"})
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
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Provincia")
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $provincia;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Localidad")
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $localidad;
    
    
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