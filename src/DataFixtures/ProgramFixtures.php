<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $programsData = [
            [
                'title' => 'Game of Thrones',
                'synopsis' => 'Dans un monde fantastique, des familles nobles se battent pour le pouvoir.',
                'category' => 'Fantastique'
            ],
            [
                'title' => 'Stranger Things',
                'synopsis' => 'En 1983, des événements étranges se produisent dans une petite ville de l\'Indiana.',
                'category' => 'Horreur'
            ],
            [
                'title' => 'La Casa de Papel',
                'synopsis' => 'Un groupe de braqueurs tente de voler la Fabrique nationale de la monnaie et du timbre.',
                'category' => 'Action'
            ],
            [
                'title' => 'Breaking Bad',
                'synopsis' => 'Un professeur de chimie atteint d\'un cancer se lance dans la fabrication de méthamphétamine.',
                'category' => 'Aventure'
            ],
            [
                'title' => 'The Crown',
                'synopsis' => 'La vie de la reine Elizabeth II, de son mariage en 1947 à nos jours.',
                'category' => 'Aventure'
            ]
        ];

        foreach ($programsData as $data) {
            $program = new Program();
            $program->setTitle($data['title']);
            $program->setSynopsis($data['synopsis']);
            $program->setCategory($this->getReference('category_' . $data['category']));
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
