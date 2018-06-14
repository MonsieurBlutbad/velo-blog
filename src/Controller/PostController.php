<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Tour;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * @Route("/{tour_slug}/{post_slug}", name="post_show", methods="GET")
     * @ParamConverter("tour", class="App\Entity\Tour", options={"mapping": {"tour_slug": "slug"}})
     * @ParamConverter("post", class="App\Entity\Post",  options={"mapping": {"post_slug": "slug"}})
     * @param Tour $tour
     * @param Post $post
     * @return Response
     */
    public function show(Request $request, Tour $tour, Post $post): Response
    {
        if (!$post->isActive() && $request->query->get('preview') === null) {
            throw new NotFoundHttpException();
        }

        if ($post->getTour() !== $tour) {
            throw new NotFoundHttpException();
        }

        $postsInTour = $post->getTour()->getActivePosts();
        $postsInTourCount = $post->getTour()->getActivePosts()->count();

        $lastPost = null;
        $nextPost = null;
        $i = 1;

        while ($i <= $postsInTourCount && (!$lastPost && !$nextPost)) {
            if ($postsInTour->get($i) === $post) {
                if ($i > 1) {
                    $lastPost = $postsInTour->get($i - 1);
                }
                if ($i + 1 <= $postsInTourCount) {
                    $nextPost = $postsInTour->get($i + 1);
                }
            }
            $i++;
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'lastPost' => $lastPost,
            'nextPost' => $nextPost,
            'isPreview' => $request->query->get('preview') !== null
        ]);
    }
}
