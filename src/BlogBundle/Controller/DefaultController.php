<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Category;
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
        $posts = $postsRepository->sortNewestToOldest();

        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $categoryRepository->findAll();

        return $this->render('blog/blog.html.twig', ['posts' => $posts, 'categories' => $categories]);
    }

    /**
     * @Route("/blog/{id}", name="showBlogItem", methods={"GET"})
     */
    public function showItemAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $postsRepository = $em->getRepository(Post::class);
        $post = $postsRepository->findOneBy(['id' => $id]);

        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $category = $categoryRepository->findAll();

        if (!$post) {
            throw new NotFoundHttpException();
        } else {
            return $this->render('blog/posts/blog-item.html.twig', ['post' => $post, 'category' => $category]);
        }


    }
}
