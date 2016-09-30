<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CosechaRepository extends EntityRepository {

    public function getBuscados($usuario, $busqueda, $fechaDesde, $fechaHasta) {
        $qb = $this->createQueryBuilder('c');
        
        $qb->select('c')
            ->innerJoin("c.siembra","s")
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario);
        
        if ($busqueda) {
            $qb->andWhere($qb->expr()->orX(
                "s.nombre LIKE :busqueda", 
                "c.beneficio LIKE :busqueda",
                "c.rinde LIKE :busqueda",
                "c.descripcion LIKE :busqueda"
            ));
            $qb->setParameter('busqueda', '%'.$busqueda.'%');
        }
        
            if ($fechaDesde) {
            $dateDesde = new \DateTime($fechaDesde);

            $qb->andWhere($qb->expr()->gte('c.fecha', ':desde'));
            $qb->setParameter('desde', $dateDesde);
        }
        
        if ($fechaHasta) {
            $dateHasta = new \DateTime($fechaHasta);
            
            $qb->andWhere($qb->expr()->lte('c.fecha', ':hasta'));
            $qb->setParameter('hasta', $dateHasta);
        }
        
        return $qb->getQuery()->getResult();
    }
    
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