<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 29/08/2016
 * Time: 18:47
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Swift_Message;

class EmailController extends Controller
{
    /**
     * @Route("/admin/emails/preview/{guest}", name="preview")
     * @param String $guest
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function preview($guest)
    {
        $guestEntityManager = $this->getDoctrine()->getEntityManager();
        $guest = $guestEntityManager->getRepository('AppBundle:Guest')->findOneBy(['email' => $guest]);

        return $this->render("admin/finalemails.html.twig",
            ['guest' => $guest,
                'email' => $this->getParameter("email_address")]);
    }

    /**
     * @Route("/admin/emails/send/{guest}")
     * @param String $guest
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendPreview($guest)
    {
        $guestEntityManager = $this->getDoctrine()->getEntityManager();
        $guest = $guestEntityManager->getRepository('AppBundle:Guest')->findOneBy(['email' => $guest]);

        $message = new \Swift_Message('Your Melanie and Colin Wedding RSVP');
        $message->setFrom($this->getParameter("email_address"))
            ->setTo($this->getUser()->getEmail())
            ->setBody(
                $this->renderView(
                    'admin/finalemails.html.twig',
                    array('guest' => $guest, 'email' => $this->getParameter("email_address"))
                ),
                'text/html'
            );

        $this->get('mailer')->send($message);

        return $this->redirectToRoute("preview", ['guest' => $guest]);
    }
}
