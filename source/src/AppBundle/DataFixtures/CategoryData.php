<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class CategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $titles = ['Резина', 'Велосипеды', 'Экиперовка', 'Автомобили', 'Станки'];
        
        for ($i = 0; $i < 5; $i++) {
            $cat = new Category();
            
            $cat->setTitle($titles[$i]);
            
            $manager->persist($cat);
            
            $this->addReference('category'.$i, $cat);
        }
        
        $manager->flush();
        
        $mainCat = new Category();
        $mainCat->setTitle('Пилы');
        
        $cat = new Category();
        $cat1 = new Category();
        $cat->setTitle('Бензопила')
            ->addParent($mainCat);
        $cat1->setTitle('Электропила')
             ->addParent($mainCat);
        
        
        
        $manager->persist($mainCat);
        $manager->flush();
        
        $this->addReference('category5', $cat);
        $this->addReference('category6', $cat1);
        $this->addReference('category7', $mainCat);
        
    }

    public function getOrder()
    {
        return 1;
    }

}