<?php

namespace Aym3ntn\MedecinBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class MedecinType extends AbstractType
{

    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->securityContext->getToken()->getUser();

        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe', 'choice', array(
                'choices' => array('male' => 'Male', 'female' => 'Female')
            ))
            ->add('age')
            ->add('tel')
            ->add('fax')
            ->add('siteWeb')
            ->add('secteur', 'entity', array(
                'class' => 'Aym3ntn\MedecinBundle\Entity\Secteur',
                'property' => 'nom',
                'required' => true,
                'empty_value' => 'Vous devez choisir le secteur auquel le medecin appartient.',
                'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('s')->join('s.users','u','WITH','u.id = :id')
                            ->setParameter('id', $this->securityContext->getToken()->getUser());
                    }
            ))
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Aym3ntn\MedecinBundle\Entity\Medecin'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aym3ntn_medecinbundle_medecin';
    }
}
