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
use Doctrine\Common\Collections\ArrayCollection;

class GuestFeaturesController extends Controller
{
    /**
     * @Route("/guest/rsvp", name="rsvp")
     */
    public function rsvp(Request $request)
    {
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guest = $guestRepository->findOneBy(['username' => $this->getUser()->getUsername()]);

        return $this->render(
            'guest/rsvp_ro.html.twig',
            array(
                'guest' => $guest,
            )
        );
    }

    /**
     * @Route("/guest/plusones", name="plusones")
     */
    public function addplusone(Request $request)
    {
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guest = $guestRepository->findOneBy(['username' => $this->getUser()->getUsername()]);
        $plusOnes = $guest->getPlusOnes();
        $plusOnes = $plusOnes->toArray();

        $forms = [];
        foreach ($plusOnes as $plusOne) {
            $forms[] = $this->createForm(PlusOneFormType::class, $plusOne);
        }

        $formViews = [];
        foreach ($forms as $form) {
            $formView = $form->createView();
            $formViews[] = $formView;
            if ($request->request->has($form)){
                $form->handleRequest($request);
            }

            if ($form->isSubmitted() && $form->isValid()) {
                $guest = $form->getData();

                $guest->setRSVPReceived(true);
                $em = $this->getDoctrine()->getManager();
                $em->persist($guest);
                $em->flush();
                return $this->redirectToRoute('plusones');
            }
        }


        return $this->render('guest/plusones.html.twig',
            array('forms' => $formViews));
    }

    /**
     * @Route("/guest/thanks", name="thanks")
     */
    public function thanks()
    {
        return $this->render(
            'guest/thanks.html.twig'
        );
    }

    /**
     * @Route("/guest/contact", name="contact")
     */
    public function contact() {
        return $this->render( 'guest/contact.html.twig', [
            'email' => $this->getParameter("email_address")
        ]);
    }

    /**
     * @Route("/guest/photos", name="photos")
     */
    public function photos() {
        return $this->render('guest/photos.html.twig');
    }
}
