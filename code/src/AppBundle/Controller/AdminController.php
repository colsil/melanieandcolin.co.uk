<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 29/08/2016
 * Time: 18:47
 */

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin/guests", name="guests")
     */
    public function guests()
    {
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guests = $guestRepository->findAll();
        return $this->render(
            'admin/guests.html.twig',
            array(
                'guests' => $guests
            )
        );
    }

    /**
     * @Route("/admin/guests/edit/{name}")
     */
    public function editGuest($name, Request $request)
    {
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guest = $guestRepository->findOneBy(['username' => $name]);

        $form = $this->createFormBuilder($guest)
            ->add('name', TextType::class, array('label' => 'First Name', 'attr' => array('class' => 'form-control')))
            ->add('surname', TextType::class, array('label' => 'Surname', 'attr' => array('class' => 'form-control')))
            ->add('invitedday', CheckboxType::class, array('label' => 'Invited - Day', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('invitedevening', CheckboxType::class, array('label' => 'Invited - Evening', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('attendingday', CheckboxType::class, array('label' => 'Attending - Day', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('attendingevening', CheckboxType::class, array('label' => 'Attending - Evening', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Save Guest'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guest = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();
            return $this->redirectToRoute('guests');
        }


        return $this->render(
            'admin/editguest.html.twig',
            array(
                'guest' => $guest,
                'form' => $form->createView(),
            )
        );
    }

}
