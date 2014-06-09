<?php

namespace Kitpages\RedirectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RedirectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sourceUrl')
            ->add('destinationUrl', 'text', array('required' => false))
            ->add('httpCode')
        ;
    }

    public function getName()
    {
        return 'kitpages_redirectbundle_redirectiontype';
    }
}
