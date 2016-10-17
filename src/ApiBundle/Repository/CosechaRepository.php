<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

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
    
    public function get5MayorRinde($usuario) {
        $qb = $this->createQueryBuilder('c');
        
        $qb->select('c')
            ->innerJoin("c.siembra","s")
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario)
            ->orderBy('c.rinde', 'DESC')
            ->setMaxResults(5);
        
        return $qb->getQuery()->getResult();
    }
    
    public function get5MenorRinde($usuario) {
        $qb = $this->createQueryBuilder('c');
        
        $qb->select('c')
            ->innerJoin("c.siembra","s")
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario)
            ->orderBy('c.rinde', 'ASC')
            ->setMaxResults(5);
        
        return $qb->getQuery()->getResult();
    }
    
    public function get5MayorBeneficio($usuario) {
        $qb = $this->createQueryBuilder('c');
        
        $qb->select('c')
            ->innerJoin("c.siembra","s")
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario)
            ->orderBy('c.beneficio', 'DESC')
            ->setMaxResults(5);
        
        return $qb->getQuery()->getResult();
    }
    
    public function get5MenorBeneficio($usuario) {
        $qb = $this->createQueryBuilder('c');
        
        $qb->select('c')
            ->innerJoin("c.siembra","s")
            ->innerJoin("s.lote","l")
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario)
            ->orderBy('c.beneficio', 'ASC')
            ->setMaxResults(5);
        
        return $qb->getQuery()->getResult();
    }
           
    public function getRindePromedioAnual($usuario) {
        $sql = "SELECT EXTRACT(YEAR FROM s.fecha) AS year, AVG(co.rinde) AS cantidad, c.nombre AS cultivo
            FROM Cosecha co
            JOIN Siembra s ON s.id = co.siembra_id            
            JOIN Lote l ON s.lote_id = l.id
            JOIN Cultivo c ON s.cultivo_id = c.id
            JOIN Usuario u ON l.usuario_id = u.id            
            WHERE u.id = $usuario
            GROUP BY EXTRACT(YEAR FROM s.fecha), c.nombre;";
        
        $rsm = new ResultSetMapping;
        $rsm->addScalarResult('year', 'year');
        $rsm->addScalarResult('cantidad', 'cantidad');
        $rsm->addScalarResult('cultivo', 'cultivo');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        
        return $query->getScalarResult();
    }
}