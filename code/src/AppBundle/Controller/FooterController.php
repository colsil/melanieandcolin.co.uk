<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 25/05/2016
 * Time: 22:13
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FooterController extends Controller
{

    public function footerAction() {
        $year = date('Y');
        return $this->render(
            'footer.html.twig',
            array(
                'year' => $year
            )
        );
    }
}
