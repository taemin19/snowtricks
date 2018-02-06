<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Trick;
use AppBundle\Form\TrickForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage community contents in the backend.
 *
 * @Route("/admin/trick")
 * @Security("has_role('ROLE_ADMIN')")
 */
class CommunityAdminController extends Controller
{
    const PER_PAGE = 6;
    const PER_MENU = 8;

    /**
     * Lists all Trick entities.
     *
     * @Route("/", defaults={"page": "1"}, name="admin_trick_index")
     * @Route("/page/{page}", requirements={"page": "[1-9]\d*"}, name="trick_index_paginated")
     * @Method("GET")
     */
    public function indexAction(int $page)
    {
        $author = $this->getUser();

        $authorTricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getLatestByAuthor($page,self::PER_PAGE, true, $author)
        ;

        $nbPages = ceil(count($authorTricks) / self::PER_PAGE);

        if ($page > $nbPages) {
            throw $this->createNotFoundException('The page does not exist');
        }

        return $this->render('admin/community/index.html.twig', [
            'tricks' => $authorTricks,
            'page' => $page,
            'nbPages' => $nbPages
        ]);
    }

    /**
     * Creates a new Trick entity.
     *
     * @Route("/new", name="admin_trick_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(TrickForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick = $form->getData();
            $trick->setAuthor($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();

            $this->addFlash('success', 'Trick created successfully!');

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);
        }
        return $this->render('admin/community/new.html.twig', [
            'form' => $form->createView()
        ]);
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
    public function deleteAction(Request $request, Trick $trick)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($trick);
        $em->flush();

        $this->addFlash('success', 'Trick deleted_successfully!');

        return $this->redirectToRoute('admin_trick_index');
    }

    public function menuAction()
    {
        $authorTricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->findBy(['author' => $this->getUser()], ['createAt' => 'DESC']);
        ;

        return $this->render('community/menu.html.twig', [
            'tricks' => $authorTricks
        ]);
    }
}
