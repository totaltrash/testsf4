<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TaskTitle;
use App\Form\TaskTitleType;
use App\Repository\TaskTitleRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/task_title")
 */
class TaskTitleController extends AbstractController
{
    /**
     * @Route("/", name="admin_task_title_index")
     * @Template
     */
    public function index(TaskTitleRepository $taskTitleRepository, SerializerInterface $serializer)
    {
        $taskTitles = $taskTitleRepository->findAll();

        return [
            'task_titles_json' => $serializer->serialize($taskTitles, 'json', ['index']),
        ];
    }

    /**
     * @Route("/new", name="admin_task_title_new", methods={"GET","POST"})
     * @Template
     */
    public function new(Request $request)
    {
        $taskTitle = new TaskTitle();
        $form = $this->createForm(TaskTitleType::class, $taskTitle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taskTitle);
            $entityManager->flush();

            return $this->redirectToRoute('admin_task_title_index');
        }

        return [
            'taskTitle' => $taskTitle,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}", name="admin_task_title_show", methods={"GET"})
     * @Template
     */
    public function show(TaskTitle $taskTitle)
    {
        return [
            'task_title' => $taskTitle,
        ];
    }

    /**
     * @Route("/{id}/delete", name="admin_task_title_delete", methods={"GET","POST"})
     * @Template
     */
    public function delete(Request $request, TaskTitle $taskTitle)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($taskTitle);
            $em->flush();
            return $this->redirectToRoute('admin_task_title_index');
        }

        return [
            'task_title' => $taskTitle,
        ];
    }

    /**
     * @Route("/{id}/edit", name="admin_task_title_edit", methods={"GET","POST"})
     * @Template
     */
    public function edit(Request $request, TaskTitle $taskTitle)
    {
        $form = $this->createForm(TaskTitleType::class, $taskTitle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_task_title_show', [
                'id' => $taskTitle->getId(),
            ]);
        }

        return [
            'taskTitle' => $taskTitle,
            'form' => $form->createView(),
        ];
    }
}
