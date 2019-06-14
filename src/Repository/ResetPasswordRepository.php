<?php

namespace App\Repository;

use App\Entity\ResetPassword;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ResetPassword|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResetPassword|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResetPassword[]    findAll()
 * @method ResetPassword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResetPasswordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ResetPassword::class);
    }

    // /**
    //  * @return ResetPassword[] Returns an array of ResetPassword objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResetPassword
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function myfindByToken($token){
        $connexion = $this->getEntityManager()->getConnection();
        $sql = 'SELECT u.id, rp.user_id, rp.token
                FROM user u
                RIGHT JOIN reset_password rp ON u.id = rp.user_id 
                WHERE token = :token ';
        $select = $connexion->prepare($sql);
        $select->bindValue(':token', $token);
        $select->execute();
            return $select->fetch();
    }

}
