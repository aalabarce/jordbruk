<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SiembraRepository extends EntityRepository {

    public function getBuscados($usuario, $busqueda, $fechaDesde, $fechaHasta, $fertilizado, $fumigado, $arado, $lote) {
        $qb = $this->createQueryBuilder('s');
        
        $qb->select('s')
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->innerJoin("s.cultivo","c")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario);
        
        if ($busqueda) {
            $qb->andWhere($qb->expr()->orX(
                "c.nombre LIKE :busqueda",
                "l.nombre LIKE :busqueda",
                "s.aguaRecibida LIKE :busqueda",
                "s.costo LIKE :busqueda",
                "s.descripcion LIKE :busqueda"
            ));
            $qb->setParameter('busqueda', '%'.$busqueda.'%');
        }
        
        if ($fertilizado) {
            $qb->andWhere($qb->expr()->eq("s.fertilizado", ":fertilizado"));
            $qb->setParameter('fertilizado', $fertilizado);
        }
        
        if ($fumigado) {
            $qb->andWhere($qb->expr()->eq("s.fumigado", ":fumigado"));
            $qb->setParameter('fumigado', $fumigado);
        }
        
        if ($arado) {
            $qb->andWhere($qb->expr()->eq("s.arado", ":arado"));
            $qb->setParameter('arado', $arado);
        }
           
        if ($fechaDesde) {
            $dateDesde = new \DateTime($fechaDesde);

            $qb->andWhere($qb->expr()->gte('s.fecha', ':desde'));
            $qb->setParameter('desde', $dateDesde);
        }
        
        if ($fechaHasta) {
            $dateHasta = new \DateTime($fechaHasta);
            
            $qb->andWhere($qb->expr()->lte('s.fecha', ':hasta'));
            $qb->setParameter('hasta', $dateHasta);
        }
        
        if ($lote) {
            $qb->andWhere($qb->expr()->eq('l.id', ':lote'));
            $qb->setParameter('lote', $lote);
        }
        
        $qb->orderBy('s.fecha', 'ASC');
        
        return $qb->getQuery()->getResult();
    }
    
    public function getUltimasSiembra($lote) {
        $qb = $this->createQueryBuilder('s');
        
        $qb->select('s')
            ->innerJoin("s.lote","l")
            ->where($qb->expr()->eq("l.id", ":lote"))
            ->setParameter('lote', $lote)
            ->orderBy("s.fecha", "DESC");
        
        return $qb->getQuery()->getResult();
    }

    public function getPorUsuario($usuario) {
        $qb = $this->createQueryBuilder('s');
        
        $qb->select('s')
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario);
        
        return $qb->getQuery()->getResult();
    }
    
    public function getPerdidas($usuario) {
        $sqb = $this->createQueryBuilder('s2')
                ->select('s2.id')
                ->innerJoin('ApiBundle:Cosecha', 'c', 'WITH', 'c.siembra = s2.id');
        
        $qb = $this->createQueryBuilder('s');
        $qb->select('s')
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->andWhere($qb->expr()->notIn('s.id', $sqb->getDQL()))
            ->andWhere("s.fecha < DATE_ADD(CURRENT_DATE(), '-90', 'day')")
            ->setParameter('usuario', $usuario);
        
        return $qb->getQuery()->getResult();
    }
    
    public function getSinCosechar($usuario) {
        $sqb = $this->createQueryBuilder('s2')
                ->select('s2.id')
                ->innerJoin('ApiBundle:Cosecha', 'c', 'WITH', 'c.siembra = s2.id');
        
        $qb = $this->createQueryBuilder('s');
        $qb->select('s')
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->andWhere($qb->expr()->notIn('s.id', $sqb->getDQL()))
            ->andWhere("s.fecha > DATE_ADD(CURRENT_DATE(), '-90', 'day')")
            ->setParameter('usuario', $usuario);
        
        return $qb->getQuery()->getResult();
    }
    
    public function getPorRangoFecha($lote, $fecha, $siembra = null) {
        $qb = $this->createQueryBuilder('s');
        $qb->select('s')
            ->innerJoin("s.lote","l")
            ->leftJoin('ApiBundle:Cosecha', 'c', 'WITH', 'c.siembra = s.id')
            ->where($qb->expr()->eq("l.id", ":lote"))
            ->andWhere("(c.id is not null and s.fecha <= :fecha and :fecha <= c.fecha) or (c.id is null and (s.fecha <= :fecha and :fecha <= DATE_ADD(s.fecha, '90', 'day')) or (s.fecha >= :fecha and :fecha >= DATE_ADD(s.fecha, '-90', 'day')))")
            ->setParameter('fecha', $fecha)
            ->setParameter('lote', $lote);
        
        if($siembra) {
            $qb->andWhere("s.id != :siembra")
                ->setParameter('siembra', $siembra);
        }

        return $qb->getQuery()->getArrayResult();
    }
}