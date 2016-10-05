<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Orders;

class OrdersData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        
        for ($i = 0; $i < 5; $i++) {
            $order = new Orders();
            $sum = 0;
            
            $randomAmountOfProducts = random_int(1, 7);
            $userIndex = random_int(1, 2);
            
            
            for ($i = 0; $i < $randomAmountOfProducts; $i++) {
                
                $accountProd = random_int(0, 39);
                
                $prod = $this->getReference('product'.$accountProd);
                $order->addProduct($prod);
                $sum += $prod->getPrice();  
                
            }
            
            $order->setSum($sum);
            $order->setType('order');
            $order->setUsers($this->getReference('user'.$userIndex));
            
            $manager->persist($order);
            
            $this->addReference('order'.$i, $order);
            
        }
        
        $manager->flush();
        
    }

    public function getOrder()
    {
        return 1;
    }
}