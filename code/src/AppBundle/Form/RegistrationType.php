<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Util\LegacyFormHelper;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'),
            array(
                'label' => 'form.email',
                'attr' => array('class' => 'form-control'),
                'translation_domain' => 'FOSUserBundle'
            )
        );
        $builder->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
            'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
            'options' => array('translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'form-control')),
            'first_options' => array('label' => 'form.password'),
            'second_options' => array('label' => 'form.password_confirmation'),
            'invalid_message' => 'fos_user.password.mismatch',
        ));
        $builder->add('username', null, array(
                'label' => 'form.username',
                'attr' => array('class' => 'form-control'),
                'translation_domain' => 'FOSUserBundle'
            )
        );
        $builder->add('name', null, array('label' => 'First Name', 'attr' => array('class' => 'form-control')));
        $builder->add('surname', null, array('attr' => array('class' => 'form-control')));
        $builder->add('invitedday', null, array('label' => 'Invited for Day', 'attr' => array('class' => 'form-control')));
        $builder->add('invitedevening', null, array('label' => 'Invited for Evening', 'attr' => array('class' => 'form-control')));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
