<?php

namespace BlogBundle\Controller;

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
        return $this->render("blog/posts/new.html.twig");
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
        $linkPhoto = "{{ asset('css/images/sample/blog/{$photo}') }}";

        $post = new Post();
        $post->setSubject($subject);
        $post->setShort($short);
        $post->setCategory($category);
        $post->setContent($content);
        $post->setPhoto($linkPhoto);
        $post->setDate(new \DateTime(date('d-F-Y')));

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response("Post created");
    }

}
