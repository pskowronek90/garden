<?php

namespace DemoBundle\Controller;

use DemoBundle\Entity\Plant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
     * @Route("/new", name="plant-new-post", methods={"POST"})
     */
    public function newPostAction(Request $request)
    {
        $file = $request->files->get('plantPhoto');
//        var_dump($_FILES);
//        exit;
        $name = $request->get('plantName');
        $description = $request->get('plantDesc');
//        $photo = $request->get('plantPhoto');
//        var_dump($photo);
//        exit;


        $plant = new Plant();
        $plant->setName($name);
        $plant->setDescription($description);

        /** @var UploadedFile $file */
        $file = $request->files->get('plantPhoto');
        $fileName = $this->generateUniqueFileName() . '.' . '.jpeg';


        // moves the file to the directory where brochures are stored
        $file->move(
            $this->getParameter('plants_directory'),
            $fileName
        );

        // updates the 'brochure' property to store the PDF file name
        // instead of its contents

        $plant->setPhoto($fileName);

        $em = $this->getDoctrine()->getManager();
        $em->persist($plant);
        $em->flush();

        return new Response("Plant Created");
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
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
