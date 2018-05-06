<?php

namespace DemoBundle\Controller;

use DemoBundle\Entity\Plant;
use DemoBundle\Entity\Task;
use DemoBundle\Entity\Tasker;
use DemoBundle\Entity\TaskTypes;
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

        $description = $request->get('taskDesc');
        $date = $request->get('taskDate');

        $plantsRepository = $this->getDoctrine()->getRepository(Plant::class);

        $task = new Task();
        $task->setDescription($description);
        $task->setDate(\DateTime::createFromFormat("Y-m-d", $date));
        $task->setPlant($plantsRepository->findOneBy(['id' => $request->get('plantID')]));
        $task->setStatus("active");

        $em = $this->getDoctrine()->getManager();
        $em->merge($task);
        $em->flush();

        return new Response("Task Created");
    }

    /**
     * @Route("/edit", name="task-edit-get", methods={"GET"})
     */
    public function editGetAction()
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findAll();

        return $this->render("admin/task/edit.html.twig", ['tasks' => $tasks]);
    }

    /**
     * @Route("/edit", name="task-edit-post", methods={"POST"})
     */
    public function editPostAction(Request $request)
    {
        $id = $request->get('taskID');
        $description = $request->get('taskDesc');
        $date = $request->get('taskDate');
        $status = $request->get('status');

        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);

        $task->setDescription($description);
        $task->setDate(\DateTime::createFromFormat("Y-m-d", $date));
        $task->setStatus($status);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return new Response("Task updated");

    }

    /**
     * @Route("/delete", name="task-delete-get", methods={"GET"})
     */
    public function deleteGetAction()
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findAll();

        return $this->render("admin/task/delete.html.twig", ['tasks' => $tasks]);
    }

    /**
     * @Route("/delete", name="task-delete-post", methods={"post"})
     */
    public function deletePostAction(Request $request)
    {
        $tasksRepo = $this->getDoctrine()->getRepository(Task::class);

        $id = $request->get('taskID');

        $em = $this->getDoctrine()->getManager();
        $em->remove($tasksRepo->findOneBy(['id' => $id]));
        $em->flush();

        return new Response("Task deleted");

    }

}
