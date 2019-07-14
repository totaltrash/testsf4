<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskTitleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/task")
 */
class TaskController extends AbstractController
{
    /**
     * @Route("/{id}", name="task_show", methods={"GET"})
     * @Template
     */
    public function show(Task $task)
    {
        return [
            'task' => $task,
        ];
    }

    /**
     * @Route("/{id}/changestatus", name="task_change_status", methods={"GET"})
     * @ParamConverter("task", options={"id" = "id"})
     * @Template
     */
    public function changeStatus(Request $request, Task $task)
    {
        $newStatus = $request->query->get('status');

        if (!in_array($newStatus, array_keys(Task::ALL_STATUS_LABELS))) {
            throw new \InvalidArgumentException('Invalid Status');
        }
        
        $task->setStatus($newStatus, $this->getUser());
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('task_show', ['id' => $task->getId()]);
    }

    /**
     * @Route("/{id}/edit", name="task_edit", methods={"GET","POST"})
     * @Template
     */
    public function edit(
        Request $request,
        Task $task,
        TaskTitleRepository $taskTitleRepo
    ) {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_show', [
                'id' => $task->getId(),
            ]);
        }

        return [
            'task' => $task,
            'form' => $form->createView(),
            'taskTitles' => $taskTitleRepo->findAll(),
        ];
    }

    /**
     * @Route("/{id}/delete", name="task_delete", methods={"GET","POST"})
     * @Template
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Task $task)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();
            return $this->redirectToRoute('project_show', ['id' => $task->getProject()->getId()]);
        }

        return [
            'task' => $task,
        ];
    }
}
