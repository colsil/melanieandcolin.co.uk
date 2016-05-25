<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 25/05/2016
 * Time: 21:49
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @Route("/login")
     */
    public function login() {
        return $this->render(
            'login.html.twig'
        );
    }
}
