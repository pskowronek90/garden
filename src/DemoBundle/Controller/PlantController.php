<?php

namespace DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/plant")
 */

class PlantController extends Controller
{
    /**
     * @Route("/new", name="plant-new-get", methods={"GET"})
     */
    public function newGetAction()
    {
        return $this->render("admin/plant/new.html.twig");
    }

    /**
     * @Route("/edit", name="plant-edit-get", methods={"GET"})
     */
    public function editGetAction()
    {
        return $this->render("admin/plant/edit.html.twig");
    }

    /**
     * @Route("/delete", name="plant-delete-get", methods={"GET"})
     */
    public function deleteGetAction()
    {
        return $this->render("admin/plant/delete.html.twig");
    }
}
