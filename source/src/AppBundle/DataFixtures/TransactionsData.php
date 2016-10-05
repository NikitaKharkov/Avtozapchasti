<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Transactions;

class TransactionsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        
        for ($i = 0; $i < 2; $i++) {
        
            $order = $this->getReference('order'.$i);

            $trans = new Transactions();
            $trans->setSumTransactions($order->getSum() * 0.4);
            $manager->persist($trans);
            $trans1 = new Transactions();
            $trans1->setSumTransactions($order->getSum() * 0.4);
            $manager->persist($trans1);
            $trans2 = new Transactions();
            $trans2->setSumTransactions($order->getSum() * 0.2);
            $manager->persist($trans2);
            
        }
        
        $order = $this->getReference('order3');
        
        $trans = new Transactions();
        $trans->setSumTransactions($order->getSum());
        $manager->persist($trans);
        
        $order = $this->getReference('order4');
        
        $trans = new Transactions();
        $trans->setSumTransactions($order->getSum());
        $manager->persist($trans);
        
        $manager->flush();
        
        
        
    }

    public function getOrder()
    {
        return 1;
    }
}