<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 01/09/2016
 * Time: 08:14
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RSVPFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'attendingevening',
                CheckboxType::class,
                array('label' => "Attending - Evening", 'required' => false, 'attr' => array('class' => 'form-control'))
            )
            ->add(
                'attendingday',
                CheckboxType::class,
                array('label' => "Attending - Day", 'required' => false, 'attr' => array('class' => 'form-control'))
            )
            ->add('SaveRSVP', SubmitType::class, array('label' => 'Save RSVP'));

    }
}
