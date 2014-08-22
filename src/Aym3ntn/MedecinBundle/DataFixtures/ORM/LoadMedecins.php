<?php
/**
 * Created by PhpStorm.
 * User: aym3ntn
 * Date: 11/08/2014
 * Time: 17:17
 */

namespace Aym3ntn\UserBundle\DataFixtures\ORM;


use Aym3ntn\MedecinBundle\Entity\Medecin;
use Aym3ntn\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadMedecinData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $medecin1 = new Medecin();
        $medecin1->setNom('Aymen');
        $medecin1->setPrenom('Tanfous');
        $medecin1->setAge(23);
        $medecin1->setFax('ezer');
        $medecin1->setTel('ezer');
        $medecin1->setSexe('Male');
        $medecin1->setSiteWeb('ezr');
        $medecin1->setSecteur($this->getReference('secteur-1'));
        $manager->persist($medecin1);
        $manager->flush();

        $this->addReference('medecin-1', $medecin1);
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
        return 35;
    }
}