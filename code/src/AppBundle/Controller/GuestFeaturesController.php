<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 01/09/2016
 * Time: 08:17
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Guest;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class GuestFeaturesController extends Controller
{
    /**
     * @Route("/guest/rsvp", name="rsvp")
     */
    public function rsvp(Request $request)
    {
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guest = $guestRepository->findOneBy(['username' => $this->getUser()->getUsername()]);

        $rsvpForm = $this->createFormBuilder($guest)
            ->add('attendingday', CheckboxType::class, array('label' => 'Attending - Day', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('attendingevening', CheckboxType::class, array('label' => 'Attending - Evening', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('SaveRSVP', SubmitType::class, array('label' => 'Save RSVP'))
            ->getForm();

        $rsvpForm->handleRequest($request);

        if ($rsvpForm->isSubmitted() && $rsvpForm->isValid()) {
            $guest = $rsvpForm->getData();
            $guest->setRSVPReceived(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();
            return $this->redirectToRoute('thanks');
        }


        return $this->render(
            'guest/rsvp.html.twig',
            array(
                'guest' => $guest,
                'form' => $rsvpForm->createView(),
            )
        );
    }

    /**
     * @Route("/guest/thanks", name="thanks")
     */
    public function thanks() {
        return $this->render(
            'guest/thanks.html.twig'
        );
    }
}
