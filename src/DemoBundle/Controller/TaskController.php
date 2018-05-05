<?php

namespace DemoBundle\Controller;

use DemoBundle\Entity\Plant;
use DemoBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/task")
 */

class TaskController extends Controller
{
    /**
     * @Route("/new", name="task-new-get", methods={"GET"})
     */
    public function newGetAction()
    {
        $plantsRepository = $this->getDoctrine()->getRepository(Plant::class);
        $plants = $plantsRepository->findAll();

        return $this->render("admin/task/new.html.twig", ['plants' => $plants]);
    }

    /**
     * @Route("/new", name="task-new-post", methods={"POST"})
     */
    public function newPostAction(Request $request)
    {

        $name = $request->get('taskName');
        $description = $request->get('taskDesc');
        $date = $request->get('taskDate');

        $plantsRepository = $this->getDoctrine()->getRepository(Plant::class);

        $task = new Task();
        $task->setName($name);
        $task->setDescription($description);
        $task->setDate(\DateTime::createFromFormat("Y-m-d", $date));
        $task->setPlant($plantsRepository->findOneBy(['id' => $request->get('plantID')]));

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return new Response("Task Created");
    }

    /**
     * @Route("/edit", name="task-edit-get", methods={"GET"})
     */
    public function editGetAction()
    {
        return $this->render("admin/task/edit.html.twig");
    }

    /**
     * @Route("/delete", name="task-delete-get", methods={"GET"})
     */
    public function deleteGetAction()
    {
        return $this->render("admin/task/delete.html.twig");
    }

}
