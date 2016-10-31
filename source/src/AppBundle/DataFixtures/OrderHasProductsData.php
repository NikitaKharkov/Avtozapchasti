<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\OrderHasProduct;
use AppBundle\Entity\Order;

class OrderHasProductData extends AbstractFixture implements OrderedFixtureInterface
{
    
    protected $arrayOfUsedProducts = [];


    public function load(ObjectManager $manager)
    {
        
        for ($i = 0; $i < 7; $i++) {
            $order = $this->getReference('order'.$i);
            
            $sum = 0;
            
            $randomAmountOfProducts = random_int(1, 7);
            
            for ($j = 0; $j < $randomAmountOfProducts; $j++) {
                
                $orderProduct = new OrderHasProduct();
                $accountProd = $this->getAccountProd();
                
                $prodAmount = random_int(1, 20);
                $prod = $this->getReference('product'.$accountProd);
                
                $orderProduct->setOrder($order);
                $orderProduct->setProduct($prod);
                $orderProduct->setAmount($prodAmount);
                $orderProduct->setTotalPrice($prodAmount * $prod->getPrice());
                
                $manager->persist($orderProduct);

                $sum += $orderProduct->getTotalPrice();  
            }

            $order->setSum($sum);
            
            $manager->flush();
            $this->arrayOfUsedProducts = [];
        }
        
    }
    
    protected function getAccountProd()
    {
        $num = random_int(0, 39);
        if (in_array($num, $this->arrayOfUsedProducts)) {
//            dump('ifYes');
            $this->arrayOfUsedProducts[] = $num;
            return $this->getAccountProd();
        } else {
//            dump('ifNo');
            $this->arrayOfUsedProducts[] = $num;
            return $num;
        }
    }

    public function getOrder()
    {
        return 8;
    }
}