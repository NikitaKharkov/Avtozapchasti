<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Products;

class ProductsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $article = ['A1-635', 'A1-434', 'A3-757', 'A-124', 'A2-514', 'A-859', 'A-132'];
        $descr = [
            'Амортизатор1 AD100, AXIS, BWS, JOG90 300mm, регулируемый NDT (красный металлик)',
            'Амортизатор2 AD100, AXIS, BWS, JOG90 300mm, регулируемый NDT (синий металлик)',
            'Цепь сборная Б-48',
            'Вал заводской Ф48',
            'Заклёпки бензопильные (заводские) Е-1241',
            'Защита бензопильная',
        ];
        $price = [243.12, 514.44, 12.32, 500, 800, 10320.50, 5000, 2300, 1000, 450];
        $imgPath = ['images/products/img1.jpg', 'images/products/img2.jpg', 'images/products/img3.jpg'];
        
        for ($i = 0; $i < 40; $i++) {
            $prod = new Products();
            
            $artIndex   = random_int(0, 6);
            $descIndex  = random_int(0, 4);
            $priceIndex = random_int(0, 9);
            $imgIndex   = random_int(0, 2);
            $provIndex  = random_int(0, 3);
            $prodIndex  = random_int(0, 4);
            $amount     = random_int(0, 30);
            
            $prod->setArticle($article[$artIndex]);
            $prod->setAmount($amount);
            $prod->setDescription($descr[$descIndex]);
            $prod->setImagepath($imgPath[$imgIndex]);
            $prod->setPrice($price[$priceIndex]);
            $prod->setIsActive(true);
            
            $prod->setCategory($this->getReference('category'.$prodIndex));
            $prod->setProviders($this->getReference('provider'.$provIndex));
            
            $manager->persist($prod);
            
            $this->setReference('product'.$i, $prod);
            
        }
        
        $manager->flush();
        
    }

    public function getOrder()
    {
        return 1;
    }
}