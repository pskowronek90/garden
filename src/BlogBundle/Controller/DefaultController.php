<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blogAction()
    {
        return $this->render('blog/blog.html.twig');
    }

    /**
     * @Route("/blog-item", name="blog-item")
     */
    public function shopItemAction()
    {
        return $this->render('blog/posts/blog-item.html.twig');
    }
}
