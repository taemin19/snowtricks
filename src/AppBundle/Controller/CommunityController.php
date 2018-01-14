<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CommunityController
{
    /**
     * @Route("/", name="community_index")
     */
    public function indexAction()
    {
        return new Response(
            '<html><body>Community Index</body></html>'
        );
    }

    /**
     * @Route("/trick", name="community_show")
     */
    public function showAction()
    {
        return new Response(
            '<html><body>Community Show</body></html>'
        );
    }

    /**
     * @Route("/trick/add", name="community_add")
     */
    public function addAction()
    {
        return new Response(
            '<html><body>Community Add</body></html>'
        );
    }

    /**
     * @Route("/trick/edit", name="community_edit")
     */
    public function editAction()
    {
        return new Response(
            '<html><body>Community Edit</body></html>'
        );
    }
}
