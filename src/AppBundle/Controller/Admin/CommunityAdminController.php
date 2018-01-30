<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage community contents in the admin part of the site.
 *
 * @Route("/admin/trick")
 * @Security("has_role('ROLE_ADMIN')")
 */
class CommunityAdminController extends Controller
{
    /**
     * Lists all Trick entities.
     *
     * @Route("/", name="admin_trick_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return new Response('<html><body>Admin index!</body></html>');
    }

    /**
     * Creates a new Trick entity.
     *
     * @Route("/new", name="admin_trick_new")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {
        return new Response('<html><body>Admin new!</body></html>');
    }

    /**
     * Displays a form to edit an existing Trick entity.
     *
     * @Route("/{id}/edit", requirements={"id": "\d+"}, name="admin_trick_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction()
    {
        return new Response('<html><body>Admin edit!</body></html>');
    }

    /**
     * Deletes a Trick entity.
     *
     * @Route("/{id}/delete", name="admin_trick_delete")
     * @Method("POST")
     */
    public function deleteAction()
    {

    }
}
