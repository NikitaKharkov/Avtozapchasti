<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Telephone;

class TelephoneData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        
        $tel = ['+380935813123', '+38093583143', '+380505133123', '+380735094315', '+3806701249123', '+38093869584', '+38097394103', '+38050003141','+38067123143'];
        
        $userIndex = 0;
        
        for ($i = 0; $i < 9; $i++) {
            
            $tel = new Telephone();
        
            if ($i % 3 == 0) {
                $userIndex++;
            }
            
            $tel->setTel($tel[$i]);
            $tel->setUsers($this->getReference('user'.$userIndex));
            
            $manager->persist($tel);
            $manager->flush();
            
        }
        
    }

    public function getOrder()
    {
        return 1;
    }
}