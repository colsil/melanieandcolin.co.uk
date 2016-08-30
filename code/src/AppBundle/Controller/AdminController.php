<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 29/08/2016
 * Time: 18:47
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Route("/admin/guests")
     */
    public function guests() {
        $year = date('Y');
        $guestRepository = $this->getDoctrine()->getRepository('AppBundle:Guest');
        $guests = $guestRepository->findAll();
        return $this->render(
            'admin/guests.html.twig',
            array('year' => $year,
                'guests' => $guests
            )
        );
    }



}
