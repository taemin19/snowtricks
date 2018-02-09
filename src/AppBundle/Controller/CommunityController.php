<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Trick;
use AppBundle\Form\CommentForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller used to manage community contents in the public part of the site.
 *
 * @Route("/snowboard")
 */
class CommunityController extends Controller
{
    const PER_PAGE = 6;
    const PER_MENU = 8;

    /**
     *
     * @Route("/", defaults={"page": "1"}, name="trick_index")
     * @Route("/page/{page}", requirements={"page": "[1-9]\d*"}, name="trick_index_paginated")
     * @Method("GET")
     */
    public function indexAction(int $page)
    {
        $tricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getLatest($page,self::PER_PAGE, true)
        ;

        $nbPages = ceil(count($tricks) / self::PER_PAGE);

        if ($page > $nbPages) {
            throw $this->createNotFoundException('The page does not exist');
        }

        return $this->render('community/index.html.twig', [
            'tricks' => $tricks,
            'page' => $page,
            'nbPages' => $nbPages
        ]);
    }

    /**
     * Displays a trick and comment form
     *
     * @Route("/tricks/{slug}", name="trick_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, string $slug)
    {
        $trick = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getOneBySlug($slug)
        ;

        if (!$trick) {
            throw $this->createNotFoundException('The trick does not exist');
        }

        $form = $this->createForm(CommentForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setAuthor($this->getUser());
            $trick->addComment($comment);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Comment added successfully!');

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);
        }
        if ($request->isMethod('POST'))
        {
            $this->addFlash('danger', 'Comment can\'t be added!');
        }

        return $this->render('community/show.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    /**
     * This controller is called directly via the render() function
     */
    public function menuAction()
    {
        $tricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getLatestWithCategory(self::PER_MENU)
        ;

        return $this->render('community/menu.html.twig', [
            'tricks' => $tricks
        ]);
    }
}
