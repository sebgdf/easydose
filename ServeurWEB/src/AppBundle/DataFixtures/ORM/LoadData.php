<?php


namespace AppBundle\DataFixtures\ORM;

use CoreBundle\Entity\Config;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadData implements FixtureInterface, ContainerAwareInterface
{

    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        $configs = [
            ['id'=>1,'name' => 'Admin Starter'],
        ];

        foreach ($configs as $config) {
            $configO = new Config();
            $configO->setId($config['id']);
            $configO->setName($config['name']);
            $manager->persist($configO);
            // Enforce specified record ID
            $metadata = $manager->getClassMetaData(get_class($configO));
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        }

        $manager->flush();
              
    }
}