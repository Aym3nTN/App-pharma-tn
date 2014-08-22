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

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();

        $user->setNom('Ben Tanfous');
        $user->setPrenom('Aymen');
        $user->setDateNaissance(new \DateTime('18-12-1992', new \DateTimeZone('Africa/Tunis')));

        $user->setUsername('aymen');
        $user->setPassword($this->encodePassword($user, 'aymen'));
        $user->setEmail('atanfous@gmail.com');
        $user->setRoles(['ROLE_DELG']);
        $user->setEnabled(1);

        $userManager->updateUser($user);


        $user2 = $userManager->createUser();
        $user2->setNom('Ben Tanfous');
        $user2->setPrenom('Oussama');
        $user2->setDateNaissance(new \DateTime('18-12-1992', new \DateTimeZone('Africa/Tunis')));

        $user2->setUsername('oussama');
        $user2->setPassword($this->encodePassword($user2, 'oussama'));
        $user2->setEmail('otanfous@gmail.com');
        $user2->setRoles(['ROLE_DELG']);
        $user2->setEnabled(1);

        $userManager->updateUser($user2);

        $this->addReference('user-d1', $user);
        $this->addReference('user-d2', $user2);

        /* ROLE SUPERVISEUR */
        $user1 = $userManager->createUser();

        $user1->setNom('Ben Tanfous');
        $user1->setPrenom('Super Aymen');
        $user1->setDateNaissance(new \DateTime('18-12-1992', new \DateTimeZone('Africa/Tunis')));

        $user1->setUsername('superaymen');
        $user1->setPassword($this->encodePassword($user1, 'superaymen'));
        $user1->setEmail('super_atanfous@gmail.com');
        $user1->setRoles(['ROLE_SUPERVISEUR']);
        $user1->setEnabled(1);

        $userManager->updateUser($user1);

        $user3 = $userManager->createUser();

        $user3->setNom('Ben Tanfous');
        $user3->setPrenom('Super Aymen');
        $user3->setDateNaissance(new \DateTime('18-12-1992', new \DateTimeZone('Africa/Tunis')));

        $user3->setUsername('superaymen1');
        $user3->setPassword($this->encodePassword($user3, 'superaymen1'));
        $user3->setEmail('super_1_atanfous@gmail.com');
        $user3->setRoles(['ROLE_SUPERVISEUR']);
        $user3->setEnabled(1);

        $userManager->updateUser($user3);

        $this->addReference('user-s1', $user1);
        $this->addReference('user-s2', $user3);

        /* ROLE CHEF PRODUIT */
        $user4 = $userManager->createUser();

        $user4->setNom('Ben Tanfous');
        $user4->setPrenom('Super Aymen');
        $user4->setDateNaissance(new \DateTime('18-12-1992', new \DateTimeZone('Africa/Tunis')));

        $user4->setUsername('supersuperaymen');
        $user4->setPassword($this->encodePassword($user4, 'supersuperaymen'));
        $user4->setEmail('super_super_atanfous@gmail.com');
        $user4->setRoles(['ROLE_CHEF_PRODUIT']);
        $user4->setEnabled(1);

        $userManager->updateUser($user4);
        $this->addReference('user-c1', $user4);

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
        return 20;
    }
}