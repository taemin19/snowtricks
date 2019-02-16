<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\User;
use AppBundle\Form\UserEditForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller used to display and manage user profile in the admin part of the site.
 *
 * @Route("/profile")
 * @Security("has_role('ROLE_ADMIN')")
 */
class UserAdminController extends Controller
{
    /**
     * Displays a user profile and a form to edit it.
     *
     * @Route("/{username}", name="admin_profile_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, string $username)
    {
        if ($username !== $this->getUser()->getUsername()) {
            throw new AccessDeniedException();
        }

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $username])
        ;

        $form = $this->createForm(UserEditForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Account updated !');

            return $this->redirectToRoute('admin_profile_show', ['username' => $this->getUser()->getUsername()]);
        }

        // Displays the edit form instead of the user name and edit link if form is not validated
        if ($request->isMethod('POST')) {
            return $this->render('admin/user/profile_show.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
                'showInfo' => '',
                'showForm' => 'show',
            ]);
        }

        return $this->render('admin/user/profile_show.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'showInfo' => 'show',
            'showForm' => '',
        ]);
    }
}
