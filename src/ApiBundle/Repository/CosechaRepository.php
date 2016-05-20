<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CosechaRepository extends EntityRepository {

    public function getPorUsuario($usuario) {
        $qb = $this->createQueryBuilder('c');
        
        $qb->select('c')
            ->innerJoin("c.siembra","s")
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario);
        
        return $qb->getQuery()->getResult();
    }
}