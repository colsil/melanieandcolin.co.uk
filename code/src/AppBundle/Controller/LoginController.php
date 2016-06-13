<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 25/05/2016
 * Time: 21:49
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LoginController
 * @package AppBundle\Controller
 */
class LoginController extends Controller
{
    /**
     * @Route("/oldlogin")
     */
    public function login() {
        return $this->render(
            'login.html.twig'
        );
    }

    /**
     * @Route("/dologin")
     *
     * @param Request $request
     */
    public function doLogin(Request $request) {
        $username = $request->get('username');
        $password = $request->get('password');

        $hashedPW = "";
    }
}
