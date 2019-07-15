<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index", methods={"GET"})
     * @Template
     */
    public function index(ContactRepository $contactRepository, SerializerInterface $serializer)
    {
        $contacts = $contactRepository->findAll();

        return [
            'contacts' => $contacts,
            'contacts_json' => $serializer->serialize($contacts, 'json', [
                'groups' => ['contact_index']
            ]),
        ];
    }

    /**
     * @Route("/new", name="contact_new", methods={"GET","POST"})
     * @Template
     */
    public function new(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('contact_index');
        }

        return [
            'contact' => $contact,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}", name="contact_show", methods={"GET"})
     * @Template
     */
    public function show(Contact $contact, SerializerInterface $serializer)
    {
        return [
            'contact' => $contact,
            // 'tasks_json' => $serializer->serialize($contact->getTasks(), 'json', ['groups' => ['contact_show']]),
        ];
    }

    /**
     * @Route("/{id}/edit", name="contact_edit", methods={"GET","POST"})
     * @Template
     */
    public function edit(Request $request, Contact $contact)
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_show', [
                'id' => $contact->getId(),
            ]);
        }

        return [
            'contact' => $contact,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}/delete", name="contact_delete", methods={"GET","POST"})
     * @Template
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Contact $contact)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
            return $this->redirectToRoute('contact_index');
        }

        return [
            'contact' => $contact,
        ];
    }
}
