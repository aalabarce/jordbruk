<?php

namespace Resources\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ATENCION: No olvidar de poner la anotarion Gedmo\SoftDeleteable(fieldName="deletedAt") cuando se extienda esta entidad. Sino no funciona el borrado logico.
 */

/**
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
Abstract class BaseEntitySoftDelete extends BaseEntity {

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    protected $deletedAt;

    public function getDeletedAt() {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt) {
        $this->deletedAt = $deletedAt;
    }

}
