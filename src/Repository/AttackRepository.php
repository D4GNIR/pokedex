<?php

namespace App\Repository;

use App\Entity\Attack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Attack>
 *
 * @method Attack|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attack|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attack[]    findAll()
 * @method Attack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attack::class);
    }

    public function add(Attack $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Attack $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAttacksByPokemonId($id)
    {
        return $this->createQueryBuilder('a')
        ->join('a.pokemon', 'pokemon')
        ->where('pokemon.id = :id')
        ->setParameter(':id', $id)
        ->setMaxResults(9)
        ->getQuery()
        ->getResult();

    }

    public function getQbAll()
    {
        return $this->createQueryBuilder('a');

    }

    public function updateQbByData($qb, $datas)
    {
            if(count($datas['types']) > 0){
                $qb
                ->join('a.type', 'type')
                ->andWhere('type IN (:type_array)')
                ->setParameter('type_array', $datas['types']);
            }
            if(isset($datas['power'])){
                $qb        
                ->andWhere('a.Power >= :power')
                ->setParameter('power', $datas['power']);
            }
            if(isset($datas['accuracy'])){
                $qb        
                ->andWhere('a.Accuracy >= :accuracy')
                ->setParameter('accuracy', $datas['accuracy']);
            }
            if(isset($datas['category']) && $datas['category']!= 'null'){
                $qb        
                ->andWhere('a.Category LIKE :category')
                ->setParameter('category', '%'.$datas['category'].'%');
            } 
            if(isset($datas['makesContact']) && $datas['makesContact']!= 'null'){
                $qb        
                ->andWhere('a.MakesContact LIKE :makesContact')
                ->setParameter('makesContact', '%'.$datas['makesContact'].'%');
            } 

            return $qb;
    }

    public function getAttacksByAjaxRequest(string $research) {

        return $this->createQueryBuilder('a')
        ->where('a.Label LIKE :research')
        ->setParameter('research' , '%'.$research.'%')
        ->getQuery()
        ->getResult()
        ;
    }

//    /**
//     * @return Attack[] Returns an array of Attack objects
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

//    public function findOneBySomeField($value): ?Attack
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
