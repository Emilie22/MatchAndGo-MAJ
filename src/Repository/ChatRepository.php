<?php

namespace App\Repository;

use App\Entity\Chat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Chat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chat[]    findAll()
 * @method Chat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Chat::class);
    }

    // /**
    //  * @return Chat[] Returns an array of Chat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Chat
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findWithChat($id) {
        $querry = $this->createQueryBuilder('c')
        ->leftJoin('c.user', 'u')
        ->addSelect('u')
        ->andWhere('u.id = :id')
        ->setParameter('id', $id)
        ->groupBy('c.salon')
        ->getQuery();
        return $querry ->execute();
        

    }
    public function viewMessage($idSalon){
        $connexion = $this->getEntityManager()->getConnection();
        $sql = 'SELECT u.id, salon_id, date_send, message, u.firstname, c.date_send
                FROM user u
                RIGHT JOIN chat c ON u.id = c.user_id 
                WHERE salon_id = :idSalon ORDER BY date_send DESC LIMIT 20';
        $select = $connexion->prepare($sql);
        $select->bindValue(':idSalon', $idSalon);
        $select->execute();
            return $select->fetchAll();
    }
    

}
