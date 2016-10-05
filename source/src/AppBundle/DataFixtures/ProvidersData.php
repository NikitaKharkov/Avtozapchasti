<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Providers;

class ProvidersData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        
        $titles = ['ЭлектроПромМаш', 'MotoCenter', 'Reno', 'Suzuki'];
        
        
        for ($i = 0; $i < 4; $i++) {

            $prov = new Providers();
            
            $prov->setName($titles[random_int(0, 3)]);
            
            $manager->persist($prov);
            
            $this->addReference('providers'.$i, $prov);
        }
        
        $manager->flush();
        
    }

    public function getOrder()
    {
        return 1;
    }
}