<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Tour;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index", methods="GET")
     * @return Response
     */
    public function index(): Response
    {
        $tours = $this->getDoctrine()->getRepository(Tour::class)->findAll();
        return $this->render('default/index.html.twig', ['tours' => $tours]);
    }
}
