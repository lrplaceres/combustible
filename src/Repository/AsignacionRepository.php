<?php

namespace App\Repository;

use App\Entity\Asignacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Asignacion>
 *
 * @method Asignacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asignacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asignacion[]    findAll()
 * @method Asignacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsignacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asignacion::class);
    }

    public function save(Asignacion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Asignacion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function buscarXchapa($value): array
    {
        return $this->createQueryBuilder('n')
            ->where('n.chapa LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('n.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function buscarChapa($value): array
    {
        return $this->createQueryBuilder('n')
            ->where('n.chapa = :val')
            ->setParameter('val', $value)
            ->orderBy('n.fecha', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function buscarXentidad($value): array
    {
        return $this->createQueryBuilder('n')
            ->orWhere('e.alias LIKE :val')
            ->orWhere('e.nombre LIKE :val')
            ->join('n.empresa', 'e')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('n.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function buscarEntidad($value): array
    {
        return $this->createQueryBuilder('n')
            ->orWhere('e.alias = :val')
            ->join('n.empresa', 'e')
            ->setParameter('val', $value)
            ->orderBy('n.fecha', 'DESC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Asignacion[] Returns an array of Asignacion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Asignacion
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
