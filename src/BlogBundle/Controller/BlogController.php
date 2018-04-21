<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * @Route("/blog/create", name="blog-create-get", methods={"GET"})
     */
    public function createGetAction()
    {
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $category = $categoryRepository->findAll();

        return $this->render("blog/posts/new.html.twig", ['category' => $category]);
    }

    /**
     * @Route("/blog/create", name="blog-create-post", methods={"POST"})
     */
    public function createPostAction(Request $request)
    {
        $subject = $request->get('subject');
        $short = $request->get('short');
        $category = $request->get('category');
        $content = $request->get('text');
        $photo = $request->get('photo');

        $post = new Post();
        $post->setSubject($subject);
        $post->setShort($short);
        $post->setCategory($category);
        $post->setContent($content);
        $post->setPhoto($photo);
        $post->setDate(new \DateTime(date('d-F-Y H:i:s')));

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response("Post created");
    }

}
