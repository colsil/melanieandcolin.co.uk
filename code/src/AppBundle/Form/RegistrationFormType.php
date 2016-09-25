<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Util\LegacyFormHelper;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'),
            array(
                'label' => "Email Address",
                'translation_domain' => 'FOSUserBundle'
            )
        )
            ->add('name', TextType::class, array('label' => "First Name"))
            ->add('surname', TextType::class, array('label' => "Surname"))
            ->add('invitedday', CheckboxType::class, array('label' => "Invited Day", 'required' => false))
            ->add('invitedevening', CheckboxType::class, array('label' => "Invited Evening", 'required' => false))
            ->add('attendingevening', CheckboxType::class, array('label' => "Attending Evening", 'required' => false))
            ->add('attendingday', CheckboxType::class, array('label' => "Attending Day", 'required' => false))
            ->add('numplusones', IntegerType::class, array('label' => "Number of PlusOnes", 'required' => false))
            ->add('saveguest', SubmitType::class, array('label' => "Save Guest"));
    }


}
