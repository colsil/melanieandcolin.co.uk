<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 01/09/2016
 * Time: 08:17
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Guest;
use AppBundle\Form\PlusOneFormType;
use AppBundle\Form\RSVPFormType;
use AppBundle\Form\RegistrationFormType;
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

        $rsvpForm = $this->createForm(RSVPFormType::class, $guest);

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
                'form' => $rsvpForm->createView(),
            )
        );
    }

    /**
     * @Route("/guest/plusones", name="plusones")
     */
    public function addplusone() {
        $form = $this->createForm(PlusOneFormType::class);

        return $this->render('guest/plusones.html.twig',
            array(
                'form' => $form->createView()
            ));
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
