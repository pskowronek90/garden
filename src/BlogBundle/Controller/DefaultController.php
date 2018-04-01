<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/blog", name="blog", methods={"GET"})
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $postsRepository = $em->getRepository(Post::class);
        $posts = $postsRepository->findAll();

        return $this->render('blog/blog.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/blog/{id}", name="showBlogItem", methods={"GET"})
     */
    public function showItemAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $postsRepository = $em->getRepository(Post::class);
        $post = $postsRepository->findOneBy(['id' => $id]);

        if (!$post) {
            throw new NotFoundHttpException();
        } else {
            return $this->render('blog/posts/blog-item.html.twig', ['post' => $post]);
        }


    }
}
