<?php

namespace Aym3ntn\MedecinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SecteurType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('region')
            ->add('description')
            ->add('user', 'entity', array(
                'class' => 'Aym3ntn\UserBundle\Entity\User',
                'required' => true,
                'empty_value' => 'Vous devez choisir un délégué pour ce secteur!'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Aym3ntn\MedecinBundle\Entity\Secteur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aym3ntn_medecinbundle_secteur';
    }
}
