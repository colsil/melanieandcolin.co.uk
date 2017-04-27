<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 05/03/2017
 * Time: 16:47
 */

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class EditGuestFormType extends RegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add(
            'rsvpReceived',
            CheckboxType::class,
            array(
                'label' => "RSVP Received",
                'required' => false
            )
        )->add(
            'vegetarian',
            CheckboxType::class, array(
                'label' => "Vegetarian meal",
                'required' => false
            )
        );
    }
}
