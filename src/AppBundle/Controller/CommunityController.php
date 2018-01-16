<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CommunityController extends Controller
{
    /**
     * @Route("/", name="community_index")
     */
    public function indexAction()
    {
        return $this->render('community/index.html.twig');
    }

    /**
     * @Route("/trick", name="community_show")
     */
    public function showAction()
    {
        return $this->render('community/show.html.twig');
    }

    /**
     * @Route("/trick/add", name="community_add")
     */
    public function addAction()
    {
        return $this->render('community/add.html.twig');
    }

    /**
     * @Route("/trick/edit", name="community_edit")
     */
    public function editAction()
    {
        return $this->render('community/edit.html.twig');
    }
}
