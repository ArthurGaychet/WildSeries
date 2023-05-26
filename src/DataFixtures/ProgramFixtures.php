<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        ['title' => 'Walking Dead', 'synopsis' => 'Des zombies envahissent la terre', 'category_name' => 'category_Action','country' => 'US', 'year' => '2010', 'program_name' => 'Walking Dead'],
        ['title' => 'Succession', 'synopsis' => 'Une famille se détruisent pour de l`argent', 'category_name' => 'category_Action','country' => 'US', 'year' => '2010', 'program_name' => 'Succession'],
        ['title' => 'The Last Of Us', 'synopsis' => 'Des zombies énervé envahissent la terre', 'category_name' => 'category_Aventure','country' => 'US', 'year' => '2010', 'program_name' => 'The Last Of Us'],
        ['title' => 'Severance', 'synopsis' => 'Une entreprise pas comme les autres', 'category_name' => 'category_Action', 'country' => 'US', 'year' => '2010', 'program_name' => 'Severance'],
        ['title' => 'Game of Thrones', 'synopsis' => 'Une partie d`échec avec des dragons', 'category_name' => 'category_Fantastique', 'country' => 'US', 'year' => '2010', 'program_name' => 'Game of Thrones'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM as $key => $programSeries) {
            $program = new Program();
            $program->setTitle($programSeries['title']);
            $program->setSynopsis($programSeries['synopsis']);
            $program->setCategory($this->getReference($programSeries['category_name']));
            $program->setCountry($programSeries['country']);
            $program->setYear($programSeries['year']);
            $this->addReference($programSeries['program_name'], $program);
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

