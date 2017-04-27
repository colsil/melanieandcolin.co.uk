<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class PlusOneFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label' => "First Name"))
            ->add('surname', TextType::class, array('label' => "Surname"));
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $guest = $event->getData();
            $form = $event->getForm();

            if ($guest->getInvitedDay()) {
                $form->add(
                    'attendingday',
                    CheckboxType::class,
                    array(
                        'label' => "Attending Day",
                        'required' => false
                    )
                )->add('vegetarian', CheckboxType::class, array(
                        'label' => "Vegetarian meal option",
                        'required' => false
                    )
                )->add('dietary',
                    TextType::class,
                    array(
                        'label' => "Other Allergies / Dietary Requirements",
                        'required' => false
                    )
                );
            }
            if ($guest->getInvitedEvening()) {
                $form->add(
                    'attendingevening',
                    CheckboxType::class,
                    array(
                        'label' => "Attending Evening",
                        'required' => false
                    )
                );
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Guest',
        ));
    }


}
