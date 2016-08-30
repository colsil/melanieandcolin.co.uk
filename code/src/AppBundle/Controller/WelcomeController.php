<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 11/04/2016
 * Time: 19:25
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function welcome() {
        return $this->render(
            'welcome.html.twig',
            array()
        );
    }

    /**
     * @Route("/where")
     */
    public function where() {
        return $this->render(
            'where.html.twig',
            array()
        );
    }

    /**
     * @Route("/when")
     */
    public function when() {
        $timings = [
            '12:00 - 12:45' => 'Guests Arrive',
            '13:00 - 13:30' => 'Ceremony',
            '13:30 - 14:00' => 'Reception Drinks',
            '14:30' => 'Canapés Served',
            '16:00 - 16:30' => 'Wedding Breakfast Starts',
            '19:00 - 19:30' => 'Evening Guests Arrive',
            '20:00' => 'Cake Cutting & First Dance',
            '20:00 - 21:00' => 'Band First Set',
            '21:00 - 22:00' => 'Evening Buffet Served',
            '22:00 - 23:00' => 'Band Second Set',
            '01:00' => 'Bar Closes'
        ];

        return $this->render(
            'when.html.twig',
            array('timings' => $timings)
        );
    }

}
