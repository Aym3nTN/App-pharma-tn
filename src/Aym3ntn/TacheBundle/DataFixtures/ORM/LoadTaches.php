<?php
/**
 * Created by PhpStorm.
 * User: aym3ntn
 * Date: 11/08/2014
 * Time: 17:17
 */

namespace Aym3ntn\UserBundle\DataFixtures\ORM;


use Aym3ntn\MedecinBundle\Entity\Secteur;
use Aym3ntn\TacheBundle\Entity\LieuTache;
use Aym3ntn\TacheBundle\Entity\ssTypeTache;
use Aym3ntn\TacheBundle\Entity\Tache;
use Aym3ntn\TacheBundle\Entity\TypeTache;
use Aym3ntn\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadTacheData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $lieu = new LieuTache();
        $lieu->setAdresse('Ariana');
        $lieu->setConvention('Oui');
        $lieu->setEtiquette('Foodz');
        $lieu->setTel('5432345');
        $lieu->setVille('Tunis');

        $manager->persist($lieu);

        $type1 = new TypeTache();
        $type1->setEtiquette('RP');
        $manager->persist($type1);

        $ssTypeRP = new ssTypeTache();
        $ssTypeRP->setEtiquette('Diner soirée');
        $ssTypeRP->setType($type1);
        $manager->persist($ssTypeRP);

        $ssTypeRP1 = new ssTypeTache();
        $ssTypeRP1->setEtiquette('Congrés');
        $ssTypeRP1->setType($type1);
        $manager->persist($ssTypeRP1);

        $type2 = new TypeTache();
        $type2->setEtiquette('Opportunité');
        $manager->persist($type2);

        $ssTypeOp = new ssTypeTache();
        $ssTypeOp->setEtiquette('Collation');
        $ssTypeOp->setType($type2);
        $manager->persist($ssTypeOp);

        $ssTypeOp1 = new ssTypeTache();
        $ssTypeOp1->setEtiquette('Petit-dej');
        $ssTypeOp1->setType($type2);
        $manager->persist($ssTypeOp1);


        $tache1 = new Tache();
        $tache1->setDate(new \DateTime('now', new \DateTimeZone('Africa/Tunis')));
        $tache1->setDescr("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci, at dicta ducimus error iste itaque magnam molestiae nam odio quaerat quas quia quibusdam tempore voluptatum? Ab aliquam aspernatur porro.");
        $tache1->setLieu($lieu);
        $tache1->setOwner($this->getReference('user-d1'));
        $tache1->setStatus(1);
        $tache1->setType($type1);
        $tache1->setSsType($ssTypeRP);

        $manager->persist($tache1);
        $manager->flush();

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
        return 36;
    }
}