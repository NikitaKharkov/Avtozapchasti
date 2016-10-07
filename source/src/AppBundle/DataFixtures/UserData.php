<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Users;

class UserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        
        $names = ['Василий Петрович', 'Геннадий Александрович', 'Колотов Максим'];
        $address = ['Украина, Харьков, Мерефа', 'Украина, Днепропетровск, Днепродзержинск', 'Россия, Москва, Мытыщи'];
        $emails = ['Vasya@mail.com', 'Gena@gmail.com', 'Kolotov@i.ua'];
        $role = 'user';
        $disc = [5, 10, 20];
        
        $this->container->get();

        $encoder = $this->container->get('security.password_encoder');
        
        
        for ($i = 0; $i < 2; $i++) {
            $user = new Users();
            $user->setFio($names[$i]);
            $user->setAddress($address[$i]);
            $user->setEmail($emails[$i]);
            $user->setRole($role);
            $user->setDiscount($disc[$i]);
            
            $password = $encoder->encodePassword($user, 'admin'.$i);
            $user->setPassword($password);
            
            
            $manager->persist($user);
            $manager->flush();
            
            $this->addReference('user'.$i, $user);
        }
        
    }

    public function getOrder()
    {
        return 1;
    }
}