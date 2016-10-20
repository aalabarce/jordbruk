<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Symfony\Component\Validator\Validation; 
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

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
     * @ORM\Column(type="string")
     * @Expose
     * @Groups({"Usuario"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $nombre;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $telefono;

    /**
     * @ORM\Column(type="string")
     * @Expose
     * @Groups({"Usuario"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
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
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $provincia;
    
    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Localidad")
     * @Expose
     * @Groups({"Usuario"})
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $localidad;
    
    /**
     * @Assert\Length(min = 8, minMessage = "Debe tener minimo 8 caracteres")
     * @Assert\NotBlank(message="Este campo es obligatorio.")
     */
    protected $plainPassword;
    
    
     public static function loadValidatorMetadata(ClassMetadata $metadata) {
        $metadata->addPropertyConstraint('username', new NotBlank(array('message' => 'Este campo es obligatorio.')));
        $metadata->addPropertyConstraint('email', new NotBlank(array('message' => 'Este campo es obligatorio.')));
     }        
        
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
    
    function getTelefono() {
        return $this->telefono;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
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