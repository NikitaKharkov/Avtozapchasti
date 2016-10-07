<?php

namespace AppBundle\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class UsersRepository extends EntityRepository implements UserLoaderInterface
{

 /**
  * Loads the user for the given username.
  *
  * This method must return null if the user is not found.
  *
  * @param string $username The username
  * @return null|Utilisateur
  * @throws \Exception
  */
  public function loadUserByUsername($username)
  {
      
    $q = $this->createQueryBuilder('u')
        ->select('u')
        ->leftJoin('u.telephone', 't')
        ->where('u.email = :name OR t.tel = :name')
        ->setParameter('name', $username)
        ->getQuery();
    try {
        $user = $q->getSingleResult();
    } catch (NoResultException $e) {
        throw new UsernameNotFoundException(sprintf('Unable to find an active user AppBundle:User object identified by "%s".', $username), 0, $e);
    } catch (NonUniqueResultException $ex) {
        throw new \Exception("The user you provided is not unique");
    }

    return $user;
  }
  
  
}