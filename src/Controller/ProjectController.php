<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Repository\ProjectTypeRepository;
use App\Repository\ProjectTitleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="project_index", methods={"GET"})
     * @Template
     */
    public function index(ProjectRepository $projectRepository, SerializerInterface $serializer)
    {
        $projects = $projectRepository->findAll();

        return [
            'projects' => $projects,
            'projects_json' => $serializer->serialize($projects, 'json', ['index']),
        ];
    }

    /**
     * @Route("/new", name="project_new", methods={"GET","POST"})
     * @Template
     */
    public function new(
        Request $request,
        ProjectTypeRepository $projectTypeRepo,
        ProjectTitleRepository $projectTitleRepo
    ) {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('project_index');
        }

        return [
            'project' => $project,
            'form' => $form->createView(),
            'projectTypes' => $projectTypeRepo->findAll(),
            'projectTitles' => $projectTitleRepo->findAll(),
        ];
    }

    /**
     * @Route("/{id}", name="project_show", methods={"GET"})
     * @Template
     */
    public function show(Project $project)
    {
        return [
            'project' => $project,
        ];
    }

    /**
     * @Route("/{id}/edit", name="project_edit", methods={"GET","POST"})
     * @Template
     */
    public function edit(
        Request $request,
        Project $project,
        ProjectTypeRepository $projectTypeRepo,
        ProjectTitleRepository $projectTitleRepo
    ) {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('project_index', [
                'id' => $project->getId(),
            ]);
        }

        return [
            'project' => $project,
            'form' => $form->createView(),
            'projectTypes' => $projectTypeRepo->findAll(),
            'projectTitles' => $projectTitleRepo->findAll(),
        ];
    }

    /**
     * @Route("/{id}", name="project_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Project $project)
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('project_index');
    }
}
