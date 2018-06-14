<?php

namespace App\Controller;

use App\Entity\Tour;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/{slug}", name="tour_show", methods="GET")
     * @ParamConverter("tour", options={"mapping": {"slug": "slug"}})
     * @param Tour $tour
     * @return Response
     */
    public function show(Request $request, Tour $tour): Response
    {
        if (!$tour->isActive() && !$request->get('preview')) {
            return new RedirectResponse($this->generateUrl('index'));
        }

        return $this->render('tour/show.html.twig', ['tour' => $tour]);
    }
}
