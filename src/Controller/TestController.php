<?php

namespace App\Controller;

// use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test")
 */
class TestController extends AbstractController
{
    /**
     * @Route("/other", name="test_other")
     */
    public function other()
    {
        return $this->render('test/other.html.twig');
    }

    /**
     * @Route("/table", name="test_table")
     */
    public function table()
    {
        return $this->render('test/table.html.twig', [
            'items' => json_encode([
                [
                    "name" => "Tino Areno",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "name" => "Bobby Slack",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "name" => "Someone Else",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "name" => "Another Dude",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "name" => "Harry Manga",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "name" => "Uncle Bob",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "name" => "Someone Areno",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "name" => "Another Slack",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "name" => "Harry Else",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "name" => "Uncle Dude",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "name" => "Tino Manga",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "name" => "Bobby Bob",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "name" => "Bobby Areno",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "name" => "Tino Slack",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "name" => "Bobby Else",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "name" => "Someone Dude",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "name" => "Another Manga",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "name" => "Harry Bob",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "name" => "Uncle Areno",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "name" => "Someone Slack",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "name" => "Another Else",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "name" => "Harry Dude",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "name" => "Uncle Manga",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "name" => "Tino Bob",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "name" => "Areno Tino",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "name" => "Slack Bobby",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "name" => "Else Someone",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "name" => "Dude Another",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "name" => "Manga Harry",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "name" => "Bob Uncle",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "name" => "Areno Someone",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "name" => "Slack Another",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "name" => "Else Harry",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "name" => "Dude Uncle",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "name" => "Manga Tino",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "name" => "Bob Bobby",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "name" => "Areno Bobby",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "name" => "Slack Tino",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "name" => "Else Bobby",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "name" => "Dude Someone",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "name" => "Manga Another",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "name" => "Bob Harry",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "name" => "Areno Uncle",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "name" => "Slack Someone",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "name" => "Else Another",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "name" => "Dude Harry",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "name" => "Manga Uncle",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "name" => "Bob Tino",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ]
            ])
        ]);
    }
}