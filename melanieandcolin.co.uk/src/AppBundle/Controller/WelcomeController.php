<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 11/04/2016
 * Time: 19:25
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController
{
    /**
     * @Route("/welcome")
     */
    public function welcome() {
        return new Response(
            '<html><body>Welcome</body></html>'
        );
    }
}
