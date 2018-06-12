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

        return $this->render('post/show.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/preview/{id}", name="post_preview", methods="GET")
     * @param Post $post
     * @return Response
     */
    public function preview(Post $post): Response
    {
        return $this->render('post/show.html.twig', ['post' => $post]);
    }
}
