<?php echo "<?php"; ?>

namespace App\Repository;

use App\Entity\UsersHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
* @method UsersHistory|null find($id, $lockMode = null, $lockVersion = null)
* @method UsersHistory|null findOneBy(array $criteria, array $orderBy = null)
* @method UsersHistory[]    findAll()
* @method UsersHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
*/
class UsersHistoryRepository extends ServiceEntityRepository
{
public function __construct(RegistryInterface $registry)
{
parent::__construct($registry, UsersHistory::class);
}

// /**
//  * @return UsersHistory[] Returns an array of UsersHistory objects
//  */
/*
public function findByExampleField($value)
{
return $this->createQueryBuilder('u')
->andWhere('u.exampleField = :val')
->setParameter('val', $value)
->orderBy('u.id', 'ASC')
->setMaxResults(10)
->getQuery()
->getResult()
;
}
*/

/*
public function findOneBySomeField($value): ?UsersHistory
{
return $this->createQueryBuilder('u')
->andWhere('u.exampleField = :val')
->setParameter('val', $value)
->getQuery()
->getOneOrNullResult()
;
}
*/
}
