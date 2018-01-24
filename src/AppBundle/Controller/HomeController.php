<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Trick;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    const PER_PAGE = 6;

    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction()
    {
        $repository =$this->getDoctrine()->getRepository(Trick::class);

        $tricks = $repository->getLatest($page = 1,self::PER_PAGE, true);

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks
        ]);
    }
}
