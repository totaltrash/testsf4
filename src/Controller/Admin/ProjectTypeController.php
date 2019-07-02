<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProjectType;
use App\Form\ProjectTypeType;
use App\Repository\ProjectTypeRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/project_type")
 */
class ProjectTypeController extends AbstractController
{
    /**
     * @Route("/", name="admin_project_type_index")
     * @Template
     */
    public function index(ProjectTypeRepository $projectTypeRepository, SerializerInterface $serializer)
    {
        $projectTypes = $projectTypeRepository->findAll();

        return [
            'project_types_json' => $serializer->serialize($projectTypes, 'json', ['index']),
        ];
    }

    /**
     * @Route("/new", name="admin_project_type_new", methods={"GET","POST"})
     * @Template
     */
    public function new(Request $request)
    {
        $projectType = new ProjectType();
        $form = $this->createForm(ProjectTypeType::class, $projectType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projectType);
            $entityManager->flush();

            return $this->redirectToRoute('admin_project_type_index');
        }

        return [
            'projectType' => $projectType,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}", name="admin_project_type_show", methods={"GET"})
     * @Template
     */
    public function show(ProjectType $projectType)
    {
        return [
            'project_type' => $projectType,
        ];
    }

    /**
     * @Route("/{id}/delete", name="admin_project_type_delete", methods={"GET","POST"})
     * @Template
     */
    public function delete(Request $request, ProjectType $projectType)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectType);
            $em->flush();
            return $this->redirectToRoute('admin_project_type_index');
        }

        return [
            'project_type' => $projectType,
        ];
    }

    /**
     * @Route("/{id}/edit", name="admin_project_type_edit", methods={"GET","POST"})
     * @Template
     */
    public function edit(Request $request, ProjectType $projectType)
    {
        $form = $this->createForm(ProjectTypeType::class, $projectType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_project_type_show', [
                'id' => $projectType->getId(),
            ]);
        }

        return [
            'projectType' => $projectType,
            'form' => $form->createView(),
        ];
    }
}
