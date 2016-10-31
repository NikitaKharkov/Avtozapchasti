<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Provider;

class ProviderData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        
        $titles = ['ЭлектроПромМаш', 'MotoCenter', 'Reno', 'Suzuki'];
        
        
        for ($i = 0; $i < 4; $i++) {

            $prov = new Provider();
            
            $prov->setName($titles[$i]);
            
            $manager->persist($prov);
            
            $this->addReference('provider'.$i, $prov);
        }
        
        $manager->flush();
        
    }

    public function getOrder()
    {
        return 5;
    }
}