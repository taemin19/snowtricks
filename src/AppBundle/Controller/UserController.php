<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserRegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * Creates a new User entity
     *
     * @Route("/register", name="user_register")
     * @Method({"GET", "POST"})
     */
    public function registerAction()
    {
        $form = $this->createForm(UserRegistrationForm::class);

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
