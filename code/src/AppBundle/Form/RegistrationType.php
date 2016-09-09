<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Util\LegacyFormHelper;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'),
            array(
                'label' => false,
                'attr' => array('class' => 'form-control'),
                'translation_domain' => 'FOSUserBundle'
            )
        );
        $builder->add('name', null, array('label' => false, 'attr' => array('class' => 'form-control')));
        $builder->add('surname', null, array('label' => false, 'attr' => array('class' => 'form-control')));
        $builder->add('invitedday', CheckboxType::class, array('label' => false, 'required' => false, 'attr' => array('class' => 'form-control')));
        $builder->add('invitedevening', CheckboxType::class, array('label' => false, 'required' => false, 'attr' => array('class' => 'form-control')));
        $builder->add('attendingevening', CheckboxType::class, array('label' => false, 'required' => false, 'attr' => array('class' => 'form-control')));
        $builder->add('attendingday', CheckboxType::class, array('label' => false, 'required' => false, 'attr' => array('class' => 'form-control')));
        $builder->add('numplusones', IntegerType::class, array('label' => false, 'required' => false, 'attr' => array('class' => 'form-control')));
    }


}
