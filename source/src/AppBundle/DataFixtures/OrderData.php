<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Order;

class OrderData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        
        for ($i = 0; $i < 7; $i++) {
            $order = new Order();
            
            $randomAmountOfProducts = random_int(1, 7);
            $userIndex = random_int(0, 2);
            
            $order->setType('order');
            $order->setStatus(random_int(0, 3));
            $order->setSum(0);
            $order->setUsers($this->getReference('user'.$userIndex));
            
            
            $manager->persist($order);
            $manager->flush();
            
            $this->addReference('order'.$i, $order);
        }
        
    }

    public function getOrder()
    {
        return 7;
    }
}