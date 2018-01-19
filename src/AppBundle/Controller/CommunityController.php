<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommunityController extends Controller
{
    /**
     * @Route("/snowboard", name="trick_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('community/index.html.twig');
    }

    /**
     * @Route("/snowboard/slug", name="trick_show")
     * @Method("GET")
     */
    public function showAction()
    {
        return $this->render('community/show.html.twig');
    }
}
