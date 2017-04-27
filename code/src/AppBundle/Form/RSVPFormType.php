<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 01/09/2016
 * Time: 08:14
 */

namespace AppBundle\Form;

use AppBundle\Entity\Guest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RSVPFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'attendingevening',
                CheckboxType::class,
                array('label' => "Attending - Evening", 'required' => false)
            )
            ->add(
                'attendingday',
                CheckboxType::class,
                array('label' => "Attending - Day", 'required' => false)
            )
            ->add('vegetarian', CheckboxType::class, array(
                    'label' => "I'd like the vegetarian meal",
                    'required' => false
                )
            )
            ->add('saveRSVP', SubmitType::class, array('label' => 'Save RSVP'));

        $builder->add('PlusOnes', CollectionType::class, array(
            'entry_type' => PlusOneFormType::class
        ));

        $builder->add(
            'rooms',
            CollectionType::class,
            array(
                'entry_type' => GuestRoomBookingFormType::class,
                'allow_add' => true,
                'allow_delete' => true
            )
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Guest::class,
        ));
    }
}
