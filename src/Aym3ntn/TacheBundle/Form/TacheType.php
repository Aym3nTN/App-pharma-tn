<?php

namespace Aym3ntn\TacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TacheType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'datetime', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'required' => true,
               // 'read_only' => true

            ))
            ->add('descr', null, array(
                'required' => true,
            ))
            ->add('medecins', null, array(
                    'multiple'  => true,
                    'required' => true,
            ))
            ->add('type','entity', array(
                'class' => 'Aym3ntn\TacheBundle\Entity\TypeTache',
                'property' => 'etiquette',
                'empty_value' => 'Vous devez choisir un type!',
                'required' => true,
            ))
            ->add('lieu', null, array(
                'property' => 'etiquette',
                'empty_value' => 'Vous devez choisir un lieu!',
                'required' => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Aym3ntn\TacheBundle\Entity\Tache',
            'csrf_protection' => false,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'task_item',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aym3ntn_tachebundle_tache';
    }
}
