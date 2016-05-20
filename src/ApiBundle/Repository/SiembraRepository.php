<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SiembraRepository extends EntityRepository {

    public function getPorUsuario($usuario) {
        $qb = $this->createQueryBuilder('s');
        
        $qb->select('s')
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario);
        
        return $qb->getQuery()->getResult();
    }
}