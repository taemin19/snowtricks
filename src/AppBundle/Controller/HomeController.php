<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    const PER_PAGE = 6;

    /**
     * @Route("/", methods={"GET"}, name="homepage")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Trick::class);

        $tricks = $repository->getLatest($page = 1, self::PER_PAGE, true);

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}
