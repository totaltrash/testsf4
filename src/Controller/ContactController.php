<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Organisation;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Repository\OrganisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function new(Request $request, OrganisationRepository $organisationRepository)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $organisationName = $form->get('organisation')->getData();
            if ($organisationName) {
                $organisation = $organisationRepository->findOneByName($organisationName);
                if ($organisation === null) {
                    $this->addFlash('success', sprintf('Created new organisation "%s"', $organisationName));
                    $organisation = new Organisation();
                    $organisation->setName($organisationName);
                    $em->persist($organisation);
                }
                $contact->setOrganisation($organisation);
            }
            $em->persist($contact);
            $this->addFlash('success', sprintf('Created new contact "%s"', $contact->getDisplayName()));
            $em->flush();

            return $this->redirectToRoute('contact_index');
        }

        return [
            'contact' => $contact,
            'form' => $form->createView(),
            'organisations' => $organisationRepository->findActive(),
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
    public function edit(Request $request, Contact $contact, OrganisationRepository $organisationRepository)
    {
        //store the original attributes
        $originalEmails = $this->copyAttributes($contact->getEmails());
        $originalPhones = $this->copyAttributes($contact->getPhones());
        $originalAddresses = $this->copyAttributes($contact->getAddresses());

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $this->removeDeletedAttributes($contact->getEmails(), $originalEmails, $em);
            $this->removeDeletedAttributes($contact->getPhones(), $originalPhones, $em);
            $this->removeDeletedAttributes($contact->getAddresses(), $originalAddresses, $em);
            
            $em->flush();

            return $this->redirectToRoute('contact_show', [
                'id' => $contact->getId(),
            ]);
        }

        return [
            'contact' => $contact,
            'form' => $form->createView(),
        ];
    }

    private function removeDeletedAttributes($collection, $originalCollection, $em)
    {
        foreach ($originalCollection as $item) {
            if (false === $collection->contains($item)) {
                $em->remove($item);
            }
        }
    }

    private function copyAttributes($collection)
    {
        $copy = new ArrayCollection();
        foreach ($collection as $item) {
            $copy->add($item);
        }
        return $copy;
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
