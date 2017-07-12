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
     * @Route("/what")
     */
    public function what() {
        return $this->render(
            'what.html.twig',
            array()
        );
    }

    /**
     * @Route("/where/accomodation")
     */
    public function accomodation() {
        return $this->render(
            'accomodation.html.twig',
            array()
        );
    }

    /**
     * @Route("/what/food", name="food")
     */
    public function food() {
        return $this->render( 'food.html.twig');
    }

    /**
     * @Route("/when")
     */
    public function when() {
        $timings = [
            '12:00 - 12:45' => 'Guests Arrive',
            '13:00 - 13:30' => 'Ceremony',
            '13:30 - 15:15' => 'Reception Drinks & Canapés Served',
            '15:15 - 15:45' => 'Speeches',
            '15:45 - 16:00' => 'Guests to be seated in Marquee',
            '16:00 - 18:00' => 'Wedding Breakfast Served',
            '19:00 - 19:30' => 'Evening Guests Arrive',
            '19:30' => 'Cutting of the Cake',
            '20:00' => 'First Dance',
            '20:00 - 21:00' => 'Band First Set',
            '20:30 - 22:30' => 'Evening Buffet Served',
            '22:00 - 23:00' => 'Band Second Set',
            '00:00' => 'Music Finishes',
            '01:00' => 'Bar Closes'
        ];

        return $this->render(
            'when.html.twig',
            array('timings' => $timings)
        );
    }

}
