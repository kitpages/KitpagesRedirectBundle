<?php

namespace Kitpages\RedirectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RedirectionType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('sourceUrl')
            ->add('destinationUrl')
            ->add('httpCode')
        ;
    }

    public function getName()
    {
        return 'kitpages_redirectbundle_redirectiontype';
    }
}
