<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Transaction;

class TransactionData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        
        for ($i = 0; $i < 2; $i++) {
        
            $order = $this->getReference('order'.$i);

            
            
            $trans = new Transaction();
            
            $trans->setSumTransactions($order->getSum() * 0.4);
            $trans->setOrders($order);
            $manager->persist($trans);
            $trans1 = new Transaction();
            $trans1->setSumTransactions($order->getSum() * 0.4);
            $trans1->setOrders($order);
            $manager->persist($trans1);
            $trans2 = new Transaction();
            $trans2->setSumTransactions($order->getSum() * 0.2);
            $trans2->setOrders($order);
            $manager->persist($trans2);

            
        }
        
        $order = $this->getReference('order3');
        
        $trans = new Transaction();
        $trans->setSumTransactions($order->getSum());
        $trans->setOrders($order);
        $manager->persist($trans);
        
        $order = $this->getReference('order4');
        
        $trans = new Transaction();
        $trans->setSumTransactions($order->getSum());
        $trans->setOrders($order);
        $manager->persist($trans);
        
        $manager->flush();
        
        
        
    }

    public function getOrder()
    {
        return 9;
    }
}