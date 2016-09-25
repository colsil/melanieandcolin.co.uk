<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 25/09/2016
 * Time: 17:26
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class EmailFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'includeInvitedDayGuests',
                CheckboxType::class,
                array('label' => "Email Invited Day Guests", 'required' => false)
            )
            ->add(
                'includeAttendingDayGuests',
                CheckboxType::class,
                array('label' => "Email Attending Day Guests", 'required' => false)
            )
            ->add(
                'includeInvitedEveningGuests',
                CheckboxType::class,
                array('label' => "Email Invited Evening Guests", 'required' => false)
            )
            ->add(
                'includeAttendingEveningGuests',
                CheckboxType::class,
                array('label' => "Email Attending Evening Guests", 'required' => false)
            )
            ->add(
                'emailContent',
                TextareaType::class,
                array('label' => "Email Content", 'required' => true)
            )
            ->add(
                'emailSubject',
                TextType::class,
                array('label' => "Email Subject", 'required' => true)
            )
            ->add('sendEmail', SubmitType::class, array('label' => 'Send Email'));
    }
}
