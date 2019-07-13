<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Form\ChangePasswordDto;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="profile_index")
     * @Template
     */
    public function index()
    {
    }

    /**
     * @Route("/changepassword", name="profile_change_password")
     * @Template
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $encoder, UserInterface $user, EntityManagerInterface $em)
    {
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $user->getPlainPassword()));
            $em->flush();

            return $this->redirectToRoute('profile_index');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
