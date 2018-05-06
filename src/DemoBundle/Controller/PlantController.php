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

        $name = $request->get('plantName');
        $description = $request->get('plantDesc');

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
        $plants = $this->getDoctrine()->getRepository(Plant::class)->findAll();

        return $this->render("admin/plant/edit.html.twig", ['plants' => $plants]);
    }


    /**
     * @Route("/edit", name="plant-edit-post", methods={"POST"})
     */
    public function editPostAction(Request $request)
    {
        $id = $request->get('plantID');
        $name = $request->get('plantName');
        $description = $request->get('plantDesc');
        $file = $request->files->get('plantPhoto');

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

        $plant = $this->getDoctrine()->getRepository(Plant::class)->findOneBy(['id' => $id]);

        $plant->setName($name);
        $plant->setDescription($description);
        $plant->setPhoto($fileName);

        $em = $this->getDoctrine()->getManager();
        $em->merge($plant);
        $em->flush();

        return new Response("Plant Updated");

    }

    /**
     * @Route("/delete", name="plant-delete-get", methods={"GET"})
     */
    public function deleteGetAction()
    {
        $plants = $this->getDoctrine()->getRepository(Plant::class)->findAll();

        return $this->render("admin/plant/delete.html.twig", ['plants' => $plants]);
    }

    /**
     * @Route("/delete", name="plant-delete-post", methods={"POST"})
     */
    public function deletePostAction(Request $request)
    {
        $plants = $this->getDoctrine()->getRepository(Plant::class);

        $id = $request->get('plantID');

        $em = $this->getDoctrine()->getManager();
        $em->remove($plants->findOneBy(['id' => $id]));
        $em->flush();

        return new Response("Plant deleted");
    }
}
