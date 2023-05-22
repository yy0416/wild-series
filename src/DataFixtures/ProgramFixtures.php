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
        // Fixtures des programmes fournis précédemment
        $programsData = [
            [
                'title' => 'Game of Thrones',
                'synopsis' => 'Dans un monde fantastique, des familles nobles se battent pour le pouvoir.',
                'category' => 'Fantastique',
                'id' => '1'
            ],
            [
                'title' => 'Stranger Things',
                'synopsis' => 'En 1983, des événements étranges se produisent dans une petite ville de l\'Indiana.',
                'category' => 'Horreur',
                'id' => '2'
            ],
            [
                'title' => 'La Casa de Papel',
                'synopsis' => 'Un groupe de braqueurs tente de voler la Fabrique nationale de la monnaie et du timbre.',
                'category' => 'Action',
                'id' => '3'
            ],
            [
                'title' => 'Breaking Bad',
                'synopsis' => 'Un professeur de chimie atteint d\'un cancer se lance dans la fabrication de méthamphétamine.',
                'category' => 'Aventure',
                'id' => '4'
            ],
            [
                'title' => 'The Crown',
                'synopsis' => 'La vie de la reine Elizabeth II, de son mariage en 1947 à nos jours.',
                'category' => 'Aventure',
                'id' => '5'
            ],
            [
                'title' => 'Arcane',
                'synopsis' => 'C\'est quoi ça je ne sais pas.',
                'category' => 'Animation',
                'id' => '6'
            ]
        ];

        foreach ($programsData as $data) {
            $program = new Program();
            $program->setTitle($data['title']);
            $program->setSynopsis($data['synopsis']);
            $program->setCategory($this->getReference('category_' . $data['category']));
            $this->addReference('program_' . $data['id'], $program);
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
