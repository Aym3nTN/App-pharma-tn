<?php
/**
 * Created by PhpStorm.
 * User: aym3ntn
 * Date: 11/08/2014
 * Time: 17:17
 */

namespace Aym3ntn\UserBundle\DataFixtures\ORM;


use Aym3ntn\MedecinBundle\Entity\Secteur;
use Aym3ntn\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadSecteurData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $secteur1 = new Secteur();
        $secteur1->setNom('Medina Jadida');
        $secteur1->setDescription('5 Hopitales');
        $secteur1->setRegion('Ben Arous');
        $secteur1->addUser($this->getReference('user-d1'));
        $secteur1->addUser($this->getReference('user-s1'));
        $secteur1->addUser($this->getReference('user-c1'));
        $manager->persist($secteur1);

        $secteur2 = new Secteur();
        $secteur2->setNom('Ariana soghra');
        $secteur2->setDescription('2 Hopitales');
        $secteur2->setRegion('Ariana');
        $secteur2->addUser($this->getReference('user-d2'));
        $secteur2->addUser($this->getReference('user-s2'));
        $secteur2->addUser($this->getReference('user-c1'));

        $manager->persist($secteur2);

        $secteur3 = new Secteur();
        $secteur3->setNom('Ariana soghra');
        $secteur3->setDescription('2 Hopitales');
        $secteur3->setRegion('Ariana');
        $secteur3->addUser($this->getReference('user-d2'));
        $secteur3->addUser($this->getReference('user-s2'));
        $secteur3->addUser($this->getReference('user-c1'));

        $manager->persist($secteur3);
        $manager->flush();

        $this->addReference('secteur-1', $secteur1);
        $this->addReference('secteur-2', $secteur2);
    }

    private function encodePassword($user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user)
        ;

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getOrder(){
        return 30;
    }
}