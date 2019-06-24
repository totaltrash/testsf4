<?php

namespace App\Controller;

// use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test")
     */
    public function table()
    {
        return $this->render('test.html.twig', [
            'items' => json_encode([
                [
                    "name" => "Tino Areno",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean"
                ],
                [
                    "name" => "Bobby Slack",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real"
                ],
                [
                    "name" => "Someone Else",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right"
                ],
                [
                    "name" => "Another Dude",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright"
                ],
                [
                    "name" => "Harry Manga",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple"
                ],
                [
                    "name" => "Uncle Bob",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam"
                ]
            ])
        ]);
    }
}