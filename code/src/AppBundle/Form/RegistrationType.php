<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Util\LegacyFormHelper;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'),
            array(
                'label' => "Email Address",
                'translation_domain' => 'FOSUserBundle'
            )
        );
        $builder->add('name', null, array('label' => "First Name"));
        $builder->add('surname', null, array('label' => "Surname"));
        $builder->add('invitedday', CheckboxType::class, array('label' => "Invited Day", 'required' => false));
        $builder->add('invitedevening', CheckboxType::class, array('label' => "Invited Evening", 'required' => false));
        $builder->add('attendingevening', CheckboxType::class, array('label' => "Attending Evening", 'required' => false));
        $builder->add('attendingday', CheckboxType::class, array('label' => "Attending Day", 'required' => false));
        $builder->add('numplusones', IntegerType::class, array('label' => "Number of PlusOnes", 'required' => false));
    }


}
