<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LoteRepository extends EntityRepository {

    public function getBuscados($usuario, $busqueda) {
        $qb = $this->createQueryBuilder('l');
        
        $qb->select('l')
            ->innerJoin("l.usuario","u")
            ->innerJoin("l.suelo","s")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->setParameter('usuario', $usuario);
        
        if ($busqueda) {
            $qb->andWhere($qb->expr()->orX(
                "l.nombre LIKE :busqueda", 
                "l.superficie LIKE :busqueda", 
                "s.nombre LIKE :busqueda", 
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

        return $qb->getQuery()->getResult();
    }
        
    public function getSueloTotalPorSiembra($usuario) {
        $sql = "SELECT count(s.id) AS cantidad, l.nombre AS lote 
            FROM Lote l
            JOIN Siembra s ON s.lote_id = l.id
            JOIN Usuario u ON l.usuario_id = u.id
            WHERE u.id == $usuario
            GROUP BY l.nombre;";
        
        $rsm = new ResultSetMapping;
        $rsm->addScalarResult('cantidad', 'cantidad');
        $rsm->addScalarResult('nombre', 'nombre');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        
        return $query->getSingleScalarResult();
    }
        
    public function getSueloPresentePorSiembra($usuario) {
        $sql = "SELECT count(s.id) AS cantidad, l.nombre AS lote 
            FROM Lote l
            JOIN Siembra s ON s.lote_id = l.id
            JOIN Usuario u ON l.usuario_id = u.id
            WHERE u.id == $usuario AND s.fecha > DATE_ADD(CURRENT_DATE(), '-90', 'day')
            GROUP BY l.nombre;";
        
        $rsm = new ResultSetMapping;
        $rsm->addScalarResult('cantidad', 'cantidad');
        $rsm->addScalarResult('nombre', 'nombre');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        
        return $query->getSingleScalarResult();
    }
}