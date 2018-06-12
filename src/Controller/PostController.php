<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * @Route("/{id}", name="post_show", methods="GET")
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response
    {
        if (!$post->isActive()) {
            return new RedirectResponse($this->generateUrl('index'));
        }

        return $this->renderPost($post);
    }

    /**
     * @Route("/preview/{id}", name="post_preview", methods="GET")
     * @param Post $post
     * @return Response
     */
    public function preview(Post $post): Response
    {
        return $this->renderPost($post);
    }

    /**
     * @param Post $post
     * @return Response
     */
    protected function renderPost(Post $post) : Response
    {
        $postsInTour = $post->getTour()->getActivePosts();
        $postsInTourCount = $post->getTour()->getActivePosts()->count();

        $lastPost = null;
        $nextPost = null;
        $i = 0;

        while ($i < $postsInTourCount && (!$lastPost && !$nextPost)) {
            if ($postsInTour->get($i) === $post) {
                if ($i > 0) {
                    $lastPost = $postsInTour->get($i - 1);
                }
                if ($i + 1 < $postsInTour) {
                    $nextPost = $postsInTour->get($i + 1);
                }
            }
            $i++;
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'lastPost' => $lastPost,
            'nextPost' => $nextPost
        ]);
    }
}
