<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/blog", name="blog", methods={"GET"})
     */
    public function blogAction()
    {
        return $this->render('blog/blog.html.twig');
    }

    /**
     * @Route("/blog/blog-item", name="blog-item")
     */
    public function showItemAction()
    {
        return $this->render('blog/posts/blog-item.html.twig');
    }
}
