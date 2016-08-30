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
        $year = date('Y');
        return $this->render(
            'welcome.html.twig',
            array('year' => $year)
        );
    }

    /**
     * @Route("/where")
     */
    public function location() {
        $year = date('Y');
        return $this->render(
            'location.html.twig',
            array('year' => $year)
        );
    }

    /**
     * @Route("/when")
     */
    public function when() {
        $year = date('Y');
        return $this->render(
            'when.html.twig',
            array('year' => $year)
        );
    }

}
