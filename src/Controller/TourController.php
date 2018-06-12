<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Tour;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tour")
 */
class TourController extends Controller
{
    /**
     * @Route("/{id}", name="tour_show", methods="GET")
     * @param Tour $tour
     * @return Response
     */
    public function show(Tour $tour): Response
    {
        if (!$tour->isActive()) {
            return new RedirectResponse($this->generateUrl('index'));
        }

        return $this->render('tour/show.html.twig', ['tour' => $tour]);
    }
}
