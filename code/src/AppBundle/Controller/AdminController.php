<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 29/08/2016
 * Time: 18:47
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
use AppBundle\Form\RegistrationType;

class AdminController extends Controller
{
    private function getRandomPassword(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    )
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

    /**
     * @Route("/admin/guests", name="guests")
     */
    public function guests(Request $request)
    {
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guests = $guestRepository->findAll();

        $numInvitedDay = count($guestRepository->findBy(['invitedday' => 1]));
        $numAttendingDay = count($guestRepository->findBy(['attendingday' => 1]));
        $numInvitedEvening = count($guestRepository->findBy(['invitedevening' => 1]));
        $numAttendingEvening = count($guestRepository->findBy(['attendingevening' => 1]));

        $form = $this->createForm(RegistrationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guest = new Guest();
            $guestdata = $form->getData();
            $guest->setEmail($guestdata['email'])
                ->setName($guestdata['name'])
                ->setSurname($guestdata['surname'])
                ->setAttendingday($guestdata['attendingday'])
                ->setInvitedday($guestdata['invitedday'])
                ->setAttendingevening($guestdata['attendingevening'])
                ->setInvitedevening($guestdata['invitedevening'])
                ->setUsername($guestdata['email'])
                ->setNumPlusOnes($guestdata['numplusones']);
            $generatedPassword = $this->getRandomPassword(12);
            $guest->setPlainPassword($generatedPassword);
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();
            return $this->redirectToRoute('guests');
        }

        return $this->render(
            'admin/guests.html.twig',
            array(
                'guests' => $guests,
                'form' => $form->createView(),
                'numInvitedDay' => $numInvitedDay,
                'numAttendingDay' => $numAttendingDay,
                'numInvitedEvening' => $numInvitedEvening,
                'numAttendingEvening' => $numAttendingEvening
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
