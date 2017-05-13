<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 29/08/2016
 * Time: 18:47
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Guest;
use AppBundle\Form\EditGuestFormType;
use AppBundle\Form\EmailFormType;
use AppBundle\Form\RegistrationFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/admin/rooms/show", name="rooms")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function rooms(Request $request) {
        $roomRepository = $this->getDoctrine()->getRepository('AppBundle:GuestRoom');

        $rooms = $roomRepository->findAll();


        return $this->render(
            'admin/rooms.html.twig',
            array(
                'rooms' => $rooms
            )
        );
    }

    /**
     * @Route("/admin/guests/show/{sort}/{direction}", name="guests")
     * @param Request $request
     * @param string $sort
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function guests(Request $request, $sort = 'surname', $direction = 'ASC')
    {
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guests = $guestRepository->findBy(array(), array($sort => $direction));

        $roomRepository = $this->getDoctrine()->getRepository('AppBundle:GuestRoom');
        $singleRooms = $roomRepository->getRoomCount('Single');
        $doubleRooms = $roomRepository->getRoomCount('Double');



        $numInvitedDay = count($guestRepository->findBy(['invitedday' => 1]));
        $numAttendingDay = count($guestRepository->findBy(['attendingday' => 1]));
        $numInvitedEvening = count($guestRepository->findBy(['invitedevening' => 1]));
        $numAttendingEvening = count($guestRepository->findBy(['attendingevening' => 1]));

        $numInvitedDayNoRSVP = count($guestRepository->findBy([ 'invitedday' => 1, 'rsvpReceived' => 0]));
        $numInvitedEveningNoRSVP = count($guestRepository->findBy([ 'invitedevening' => 1, 'rsvpReceived' => 0]));

        $form = $this->createForm(RegistrationFormType::class, null, ['guests' => $guests]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guest = new Guest();
            $guestdata = $form->getData();
            if (!is_null($guestdata['masterguest'])) {
                $masterguest = $guestRepository->find($guestdata['masterguest']);
                $guest->setMasterGuest($masterguest);
            }
            $guest->setEmail($guestdata['email'])
                ->setName($guestdata['name'])
                ->setSurname($guestdata['surname'])
                ->setAttendingday($guestdata['attendingday'])
                ->setInvitedday($guestdata['invitedday'])
                ->setAttendingevening($guestdata['attendingevening'])
                ->setInvitedevening($guestdata['invitedevening'])
                ->setUsername($guestdata['email']);
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
                'numAttendingEvening' => $numAttendingEvening,
                'numInvitedDayNoRSVP' => $numInvitedDayNoRSVP,
                'numInvitedEveningNoRSVP' => $numInvitedEveningNoRSVP,
                'doubleRooms' => $doubleRooms,
                'singleRooms' => $singleRooms
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
        $guests = $guestRepository->findAll();

        $form = $this->createForm(EditGuestFormType::class, $guest, ['guests' => $guests]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guest = $form->getData();
            if (!is_null($guest->getMasterGuest())) {
                $masterGuest = $guestRepository->find($guest->getMasterGuest());
                $guest->setMasterGuest($masterGuest);
            }
            $guest->setUsername($guest->getEmail());
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();
            return $this->redirectToRoute('guests');
        }


        return $this->render(
            'admin/editguest.html.twig',
            array(
                'guest' => $guest,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Renders a list of emails (without guests plusones) for feeding to mailchimp as a csv
     *
     * @Route("/admin/emails/{filter}")
     */
    public function getEmailList($filter = null)
    {
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guests = null;

        if ($filter) {
            $guests = $guestRepository->findBy(array($filter => true, 'masterGuest' => null));
        } else {
            $guests = $guestRepository->findBy(array('masterGuest' => null));
        }

        return $this->render(
            'admin/emails.html.twig',
            array(
                'guests' => $guests
            )
        );
    }

    /**
     * Renders a list of emails (without guests plusones) for feeding to mailchimp as a csv
     * EXCLUDES those who have rsvp'd no
     *
     * @Route("/admin/attendingDay/emails")
     */
    public function getEmailListExcludingDeclined() {
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guests = $guestRepository->getDayGuestsForEmails();

        return $this->render(
                'admin/emails.html.twig',
                array(
                    'guests' => $guests
                )
        );
    }

}
