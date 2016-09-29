<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LoteRepository extends EntityRepository {

    public function getBuscados($usuario, $busqueda) {
        $qb = $this->createQueryBuilder('l');
        
        $qb->select('l')
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario);
        
        if ($busqueda) {
            $qb->andWhere($qb->expr()->orX(
                "l.nombre LIKE :busqueda", 
                "l.superficie LIKE :busqueda", 
                "l.suelo LIKE :busqueda", 
                "l.descripcion LIKE :busqueda"
            ));
            $qb->setParameter('busqueda', '%'.$busqueda.'%');
        }
        
        return $qb->getQuery()->getResult();
    }
    
    public function getPorUsuario($usuario) {
        $qb = $this->createQueryBuilder('l');
        
        $qb->select('l')
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario);
        
        return $qb->getQuery()->getArrayResult();
    }
}