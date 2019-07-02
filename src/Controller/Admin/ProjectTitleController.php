<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProjectTitle;
use App\Form\ProjectTitleType;
use App\Repository\ProjectTitleRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/project_title")
 */
class ProjectTitleController extends AbstractController
{
    /**
     * @Route("/", name="admin_project_title_index")
     * @Template
     */
    public function index(ProjectTitleRepository $projectTitleRepository, SerializerInterface $serializer)
    {
        $projectTitles = $projectTitleRepository->findAll();

        return [
            'project_titles_json' => $serializer->serialize($projectTitles, 'json', ['index']),
        ];
    }

    /**
     * @Route("/new", name="admin_project_title_new", methods={"GET","POST"})
     * @Template
     */
    public function new(Request $request)
    {
        $projectTitle = new ProjectTitle();
        $form = $this->createForm(ProjectTitleType::class, $projectTitle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projectTitle);
            $entityManager->flush();

            return $this->redirectToRoute('admin_project_title_index');
        }

        return [
            'projectTitle' => $projectTitle,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}", name="admin_project_title_show", methods={"GET"})
     * @Template
     */
    public function show(ProjectTitle $projectTitle)
    {
        return [
            'project_title' => $projectTitle,
        ];
    }

    /**
     * @Route("/{id}/delete", name="admin_project_title_delete", methods={"GET","POST"})
     * @Template
     */
    public function delete(Request $request, ProjectTitle $projectTitle)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectTitle);
            $em->flush();
            return $this->redirectToRoute('admin_project_title_index');
        }

        return [
            'project_title' => $projectTitle,
        ];
    }

    /**
     * @Route("/{id}/edit", name="admin_project_title_edit", methods={"GET","POST"})
     * @Template
     */
    public function edit(Request $request, ProjectTitle $projectTitle)
    {
        $form = $this->createForm(ProjectTitleType::class, $projectTitle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_project_title_show', [
                'id' => $projectTitle->getId(),
            ]);
        }

        return [
            'projectTitle' => $projectTitle,
            'form' => $form->createView(),
        ];
    }
}
