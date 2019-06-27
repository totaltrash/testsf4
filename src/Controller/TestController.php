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
     * @Route("/service", name="test_service")
     */
    public function service(\App\SomeService\SomeService $service)
    {
        $number = 128;
        $doubled = $service->doubleIt($number);
        return $this->render('test/service.html.twig', [
            'number' => $number,
            'doubled' => $doubled,
        ]);
    }

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
                    "id" => 1,
                    "name" => "Tino Areno",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "id" => 2,
                    "name" => "Bobby Slack",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "id" => 3,
                    "name" => "Someone Else",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "id" => 4,
                    "name" => "Another Dude",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "id" => 5,
                    "name" => "Harry Manga",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "id" => 6,
                    "name" => "Uncle Bob",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "id" => 7,
                    "name" => "Someone Areno",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "id" => 8,
                    "name" => "Another Slack",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "id" => 9,
                    "name" => "Harry Else",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "id" => 10,
                    "name" => "Uncle Dude",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "id" => 11,
                    "name" => "Tino Manga",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "id" => 12,
                    "name" => "Bobby Bob",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "id" => 13,
                    "name" => "Bobby Areno",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "id" => 14,
                    "name" => "Tino Slack",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "id" => 15,
                    "name" => "Bobby Else",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "id" => 16,
                    "name" => "Someone Dude",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "id" => 17,
                    "name" => "Another Manga",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "id" => 18,
                    "name" => "Harry Bob",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "id" => 19,
                    "name" => "Uncle Areno",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "id" => 20,
                    "name" => "Someone Slack",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "id" => 21,
                    "name" => "Another Else",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "id" => 22,
                    "name" => "Harry Dude",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "id" => 23,
                    "name" => "Uncle Manga",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "id" => 24,
                    "name" => "Tino Bob",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "id" => 25,
                    "name" => "Areno Tino",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "id" => 26,
                    "name" => "Slack Bobby",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "id" => 27,
                    "name" => "Else Someone",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "id" => 28,
                    "name" => "Dude Another",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "id" => 29,
                    "name" => "Manga Harry",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "id" => 30,
                    "name" => "Bob Uncle",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "id" => 31,
                    "name" => "Areno Someone",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "id" => 32,
                    "name" => "Slack Another",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "id" => 33,
                    "name" => "Else Harry",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "id" => 34,
                    "name" => "Dude Uncle",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "id" => 35,
                    "name" => "Manga Tino",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "id" => 36,
                    "name" => "Bob Bobby",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "id" => 37,
                    "name" => "Areno Bobby",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "id" => 38,
                    "name" => "Slack Tino",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "id" => 39,
                    "name" => "Else Bobby",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "id" => 40,
                    "name" => "Dude Someone",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "id" => 41,
                    "name" => "Manga Another",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "id" => 42,
                    "name" => "Bob Harry",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ],
                [
                    "id" => 43,
                    "name" => "Areno Uncle",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it clean",
                    "active" => true,
                ],
                [
                    "id" => 44,
                    "name" => "Slack Someone",
                    "role" => "Software Engineer",
                    "code" => "Always keeping it real",
                    "active" => true,
                ],
                [
                    "id" => 45,
                    "name" => "Else Another",
                    "role" => "Database Guru",
                    "code" => "Always keeping it right",
                    "active" => false,
                ],
                [
                    "id" => 46,
                    "name" => "Dude Harry",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it bright",
                    "active" => true,
                ],
                [
                    "id" => 47,
                    "name" => "Manga Uncle",
                    "role" => "Frontend Dev",
                    "code" => "Always keeping it purple",
                    "active" => false,
                ],
                [
                    "id" => 48,
                    "name" => "Bob Tino",
                    "role" => "Team Leader",
                    "code" => "Always keeping it steam",
                    "active" => true,
                ]
            ])
        ]);
    }
}