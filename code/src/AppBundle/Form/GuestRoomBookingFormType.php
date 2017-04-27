<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 02/04/2017
 * Time: 11:42
 */

namespace AppBundle\Form;

use AppBundle\Entity\GuestRoom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class GuestRoomBookingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'type',
                ChoiceType::class,
                array(
                    'label' => "Room Type",
                    'choices' => [
                        'Single - £60' => 'Single',
                        'Double - £80' => 'Double'
                    ],
                    'required' => true
                )
            )
            ->add(
                'number',
                IntegerType::class,
                array('label' => "Number of Rooms Required", 'required' => true)
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GuestRoom::class,
        ));
    }
}
