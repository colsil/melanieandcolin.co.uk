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
            'welcome.html.twig'
        );
    }
}
