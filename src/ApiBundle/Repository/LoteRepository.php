<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

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
    
    public function getPorNombre($nombre, $usuario) {
        $qb = $this->createQueryBuilder('l');
        
        $qb->select('l')
            ->innerJoin("l.usuario","u")
            ->where($qb->expr()->eq("u.id", ":usuario"))
            ->andWhere($qb->expr()->eq("l.nombre", ":nombre"))
            ->setParameter('nombre', $nombre)
            ->setParameter('usuario', $usuario);

        return $qb->getQuery()->getOneOrNullResult();
    }
        
    public function getSueloTotalPorSiembra($usuario) {
        $sql = "SELECT SUM(l.superficie) AS cantidad, c.nombre AS cultivo 
            FROM Lote l
            JOIN Usuario u ON l.usuario_id = u.id
            JOIN Siembra s ON s.lote_id = l.id
            JOIN Cultivo c ON s.cultivo_id = c.id
            WHERE u.id = $usuario
            GROUP BY c.nombre;";
        
        $rsm = new ResultSetMapping;
        $rsm->addScalarResult('cantidad', 'cantidad');
        $rsm->addScalarResult('cultivo', 'cultivo');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        
        return $query->getScalarResult();
    }
        
    public function getSueloPresentePorSiembra($usuario) {
        $sql = "SELECT SUM(l.superficie) AS cantidad, c.nombre AS cultivo
            FROM Lote l
            JOIN Usuario u ON l.usuario_id = u.id
            JOIN Siembra s ON s.lote_id = l.id
            JOIN Cultivo c ON s.cultivo_id = c.id
            WHERE u.id = $usuario AND DATEDIFF(s.fecha, CURRENT_DATE()) < -90
            GROUP BY c.nombre;";
        
        $rsm = new ResultSetMapping;
        $rsm->addScalarResult('cantidad', 'cantidad');
        $rsm->addScalarResult('cultivo', 'cultivo');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        
        return $query->getScalarResult();
    }
}