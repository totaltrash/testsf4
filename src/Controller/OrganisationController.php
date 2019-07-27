<?php

namespace App\Controller;

use App\Entity\Organisation;
use App\Form\OrganisationType;
use App\Repository\OrganisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/organisation")
 */
class OrganisationController extends AbstractController
{
    /**
     * @Route("/", name="organisation_index", methods={"GET"})
     * @Template
     */
    public function index(OrganisationRepository $organisationRepository, SerializerInterface $serializer)
    {
        $organisations = $organisationRepository->findAll();

        return [
            'organisations' => $organisations,
            'organisations_json' => $serializer->serialize($organisations, 'json', [
                'groups' => ['organisation_index']
            ]),
        ];
    }

    /**
     * @Route("/new", name="organisation_new", methods={"GET","POST"})
     * @Template
     */
    public function new(Request $request)
    {
        $organisation = new Organisation();
        $form = $this->createForm(OrganisationType::class, $organisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organisation);
            $em->flush();

            return $this->redirectToRoute('organisation_index');
        }

        return [
            'organisation' => $organisation,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}", name="organisation_show", methods={"GET"})
     * @Template
     */
    public function show(Organisation $organisation, SerializerInterface $serializer)
    {
        return [
            'organisation' => $organisation,
            // 'tasks_json' => $serializer->serialize($organisation->getTasks(), 'json', ['groups' => ['organisation_show']]),
        ];
    }

    /**
     * @Route("/{id}/edit", name="organisation_edit", methods={"GET","POST"})
     * @Template
     */
    public function edit(Request $request, Organisation $organisation)
    {
        $form = $this->createForm(OrganisationType::class, $organisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('organisation_show', [
                'id' => $organisation->getId(),
            ]);
        }

        return [
            'organisation' => $organisation,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}/delete", name="organisation_delete", methods={"GET","POST"})
     * @Template
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Organisation $organisation)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($organisation);
            $em->flush();
            return $this->redirectToRoute('organisation_index');
        }

        return [
            'organisation' => $organisation,
        ];
    }
}
