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
use Symfony\Component\Form\FormBuilderInterface;

class RSVPFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('attendingevening', CheckboxType::class, array('label' => false, 'required' => false, 'attr' => array('class' => 'form-control')));
        $builder->add('attendingday', CheckboxType::class, array('label' => false, 'required' => false, 'attr' => array('class' => 'form-control')));
    }
}
