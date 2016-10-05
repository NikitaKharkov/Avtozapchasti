<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Delivery;

class DeliveryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        
        $types = ['npochta', 'delivery', 'intime'];
        $names = ['Отделение №2', 'Отделение №12', 'Отделение №15', 'Борщаговка', 'Плехановка'];
        
        $userIndex = 0;
        
        for ($i = 0; $i < 9; $i++) {
            $del = new Delivery();
            
            $typeIndex = random_int(0, 2);
            if ($i % 3 == 0) {
                $userIndex++;
            }
            $namesIndex = random_int(0, 4);
            
            $del->setName($names[$namesIndex]);
            $del->setType($types[$typeIndex]);
            $del->setUsers($this->getReference('user'.$userIndex));
            
            $manager->persist($del);
            
        }

        $manager->flush();
        
    }

    public function getOrder()
    {
        return 1;
    }
}